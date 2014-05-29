<?php

use Symfony\Component\Finder\Finder;

/**
 * This class mainly assists with parsing Photoshop PSD files. It extracts layers as PNG images, and converts the
 * document structure information to a JSON structure, which is ultimately stored in the MySQL database.
 */
class PhotoshopHelper
{
    /**
     * @var Imagick imagick Imagemagick object used for parsing PSDs
     */
    protected $imagick;

    /**
     * @var string open_file Filename of currently open PSD document
     */
    protected $open_file;

    /**
     * Constructor
     */
    public function __construct()
    {
        if (!extension_loaded('imagick')) {
            throw new Exception('Imagemagick extension has not been loaded/installed!');
        }
    }

    /**
     * Parses the given path, iterating over each PSD document.
     *
     * @param string $path The absolute path to be parsed
     * @param string $alias Alias name for the template to be parsed
     *
     * @return string A JSON string is returned containing the parsed and required PSD document data.
     */
    public function parsePath($path, $alias)
    {
        // Set product/template unique id
        $processed_data = [];

        // Iterate PSD files in the given path for processing
        $finder = new Finder();
        foreach ($finder->files()->name("*.psd")->in($path) as $file) {
            $file = $file->getRealPath();
            $filename = basename($file);
            $is_spread = preg_match('/^[\d]+-[\d]+/', $filename) ? true : false; // Matches like 01-02.psd

            if (!$is_spread) {
                // Parse a single page PSD
                $page_key = "page_" . str_pad(preg_replace('/.psd/', '', $filename), 2, '0', STR_PAD_LEFT);
                $processed_data['pages'][$page_key] = $this->parsePsd($file, $alias);
            } else {
                // Parse a spread PSD with 2 pages in the document, odd on the left, even on the right
                $page_numbers = preg_split('/-/', preg_replace('/.psd/', '', $filename));
                $odd = true;
                foreach ($page_numbers as $page_number) {
                    $page_key = "page_" . str_pad($page_number, 2, '0', STR_PAD_LEFT);
                    $processed_data['pages'][$page_key] = $this->parsePsd($file, $alias, true, $odd);
                    $odd = $odd == true ? false : true; // Are we processing odd/even(left/right) page?
                }

                // For page 0-n.psd, swap the pages, as the cover page is on the right, and back cover on the left.
                if ((int)$page_numbers[0] == 0) {
                    $page_front = 'page_00';
                    $page_back = $page_key;
                    $tmp = $processed_data['pages'][$page_front];
                    $processed_data['pages'][$page_front] = $processed_data['pages'][$page_back];
                    $processed_data['pages'][$page_back] = $tmp;
                }
            }
        }

        // Do some sorting, just to be tidy
        ksort($processed_data['pages']);

        return json_encode($processed_data);
    }
    /**
     * Parses a single PSD document. Some PSDs are spreads, meaning they contain two pages per document. The left is
     * referred to as the odd page, and the right is referred to as the even page. For the cover and back cover spread,
     * the cover is always on the right, and the back cover on the left!
     *
     * @param string $psd_file The PSD file path and name to parse
     * @param string $alias The unique product/template id
     * @param bool $is_spread If true, this document is parsed as a spread
     * @param bool $odd If $is_spread, this indicates if the odd/even side is to be parsed.
     *
     * @return array
     */
    public function parsePsd($psd_file, $alias, $is_spread = false, $odd = true)
    {
        $this->open($psd_file);
        $export_images_dir = public_path() . "/assets/{$alias}";

        // Prepare extraction folder
        prep_dir($export_images_dir, 0777, true);

        // Extract page thumbnail image, but only for cover page
        if (preg_match('/^0{1,2}-\d{1,2}.psd$|^0{1,2}.psd$/', basename($psd_file))) {
            // This is the over page, render the template thumbnail
            $this->exportThumbnail($export_images_dir, "thumbnail.png", $is_spread);
        }

        // Get PSD dimensions, DPI and number of layers
        $psd_data = $this->getDimensions($psd_file);
        $psd_data['dpi'] = $this->imagick->getImageResolution();
        $num_layers = $this->imagick->getNumberImages();

        // Iterate layers for the current PSD
        for ($i = 1; $i < $num_layers; $i++) {
            $this->imagick->setIteratorIndex($i);

            // Get image properties
            $properties = $this->imagick->getImageProperties();
            $layer_data = $this->imagick->getImagePage();

            // Check if this layer is a graphics or placeholder layer
            $key = array_key_exists('label', $properties) && preg_match('/^\$/', $properties['label']) ?
                'placeholders' : 'layers';

            // Ignore layers with blank names
            $layer_name = array_key_exists('label', $properties) ? slugify($properties['label']) : '';
            if ($layer_name == "") {
                continue;
            }

            // If this is a spread, ignore the layers from the side not being processed in this iteration
            $center = $psd_data['width'] / 2;
            if ($is_spread) {
                if ($odd && $layer_data['x'] >= $center) {
                    continue; // Pull only elements on left of spread
                } elseif (!$odd && ($layer_data['x'] + $layer_data['width']) <= $center) {
                    continue; // Pull only elements on right of spread
                }
            }

            // Calculate image offset. Pull x left by 1x page width if layer is on the right hand page.
            $image_info = [
                'x' => ($is_spread && !$odd) ? $layer_data['x'] - $center: $layer_data['x'],
                'y' => $layer_data['y'],
                'width' => (int)$layer_data['width'],
                'height' => (int)$layer_data['height']
            ];

            $page_geometry = [
                'width' => $is_spread ? $psd_data['width'] / 2 : $psd_data['width'],
                'height' => $psd_data['height']
            ];

            // Get the crop region, so we don't send images that are larger than the page canvas area over the wire
            $clip_region = $this->calculateCropRectangle($image_info, $page_geometry);

            // Create a unique id and export the layer as a .png image
            $uniqid = substr($layer_name, 0, 8) . "_" . uniqid();
            $lowres_url = $highres_url = "";
            if ($key == 'layers') {
                $exported_image_page = $this->exportCurrentImage(
                    $export_images_dir,
                    "{$uniqid}.png",
                    $is_spread,
                    $clip_region
                );

                // We need to update the layer dimensions and position
                $image_info = array_merge($image_info, $exported_image_page); // Set the new width and height
                if (!is_null($clip_region)) {
                    $image_info['x'] += $clip_region['x'];
                    $image_info['y'] += $clip_region['y'];
                }
                if (array_key_exists('lowres_filename', $image_info)) {
                    $lowres_url = "/assets/{$alias}/72dpi/" . basename($image_info['lowres_filename']);
                }
                $highres_url = "/assets/{$alias}/300dpi/" . basename($image_info['highres_filename']);
                unset($image_info['lowres_filename'], $image_info['highres_filename']);
            }

            // Create and push object representing this layer onto the resulting array
            $psd_data[$key][] = array_merge(
                [
                    'uniqid' => $uniqid,
                    'lowres_url' => $lowres_url,
                    'highres_url' => $highres_url,
                    'name' => $layer_name
                ],
                $image_info
            );
        }

        return $psd_data;
    }

    /**
     * Calculate the crop rectangle for the source rectangle, constrained to the given rectangular boundary. The source
     * and boundaries contain associative arrays with the following properties: x, y, width and height.
     *
     * @param array $source The source rectangle to be cropped
     * @param array $boundary The boundary which the source is cropped/trimmed within
     *
     * @return array|null
     */
    protected function calculateCropRectangle($source, $boundary)
    {
        $result = [];

        // Determine which edges in $source overlaps outside the $boundary
        $left_overlaps = $source['x'] < 0;
        $right_overlaps = $source['x'] + $source['width'] > $boundary['width'];
        $top_overlaps = $source['y'] < 0;
        $bottom_overlaps = $source['y'] + $source['height'] > $boundary['height'];

        if (!$left_overlaps && !$right_overlaps && !$top_overlaps && !$bottom_overlaps) {
            // If none of the edges overlap the boundary, just return null.
            return null;
        }

        // Calculate crop constraints
        $result['x'] = $left_overlaps ? abs($source['x']) : 0;
        $result['y'] = $top_overlaps ? abs($source['y']) : 0;

        $result['width'] = ($right_overlaps ? $boundary['width'] - $source['x'] : $source['width']) - $result['x'];
        $result['height'] = ($bottom_overlaps ? $boundary['height'] - $source['y'] : $source['height']) - $result['y'];

        return $result;
    }

    /**
     * Exports the current layer pointed to by setIteratorIndex() as a PNG image, with the given path and filename.
     * If $size is null, both the original image as well as a 72dpi image for web loading will be saved.
     *
     * @param string $dirname Directory where image is to be saved
     * @param string $filename Filename of the PNG to be saved
     * @param bool $is_spread If true, the image will be cropped revealing the left half only. Handy for cover preview
     * @param null $clip_bounds Rectangular region where image is to be cropped
     *
     * @return array Returns the image page size of the exported image
     */
    protected function exportCurrentImage($dirname, $filename, $is_spread = false, $clip_bounds = null)
    {
        // Clone the Imagick object so we don't change the original. Images are exported twice where the image spans
        // accross the odd and even page, and cropping the original will cause this method to crash.
        $im_clone = clone $this->imagick;
        $im_clone->setIteratorIndex($this->imagick->getIteratorIndex());
        $im_clone->setImageFormat('png');

        if (!is_null($clip_bounds) && $clip_bounds['width'] > 0 && $clip_bounds['height'] > 0) {
            // Clip image if $clip_bounds is set
            $im_clone->setImagePage(0, 0, 0, 0);
            $im_clone->cropImage(
                $clip_bounds['width'],
                $clip_bounds['height'],
                $clip_bounds['x'],
                $clip_bounds['y']
            );
        }

        // Save the 300dpi high resolution image
        $dpi = $im_clone->getImageResolution()['x'];
        $dpi_path = "{$dpi}dpi";
        prep_dir("{$dirname}/{$dpi_path}", 0777, true);
        $destination = "{$dirname}/{$dpi_path}/{$filename}";
        $im_clone->writeImage("{$destination}");
        $new_image_info = $this->getDimensions("{$destination}");
        $new_image_info['highres_filename'] = realpath($destination);

        // Save two versions, the original, and a 72dpi version for web loading.

        // Calculate the size for the 72dpi low resolution image
        $target_dpi = 72;
        $dpi_path = '72dpi';
        $scale = $target_dpi / $dpi;

        $size_72dpi = [
            'width' => max(1, round($new_image_info['width'] * $scale)),
            'height' => max(1, round($new_image_info['height'] * $scale))
        ];

        $im_clone = clone $this->imagick;
        $im_clone->setIteratorIndex($this->imagick->getIteratorIndex());
        $im_clone->setImageFormat('png');
        $im_clone->scaleImage($size_72dpi['width'], $size_72dpi['height'], false);

        prep_dir("{$dirname}/{$dpi_path}/", 0777, true);
        $destination = "{$dirname}/{$dpi_path}/{$filename}";
        $im_clone->writeimage($destination);

        // Check if 72dpi image contains alpha, if not, convert to JPG
        $channels = exec("identify -format '%[channels]' {$destination}");
        if ($channels == "srgb") {
            // Convert to JPG
            $jpeg_name = "{$dirname}/{$dpi_path}/" . basename($destination, "png") . "jpg";
            exec("convert {$destination} {$jpeg_name}");

            // Unlink the original PNG, we'll be using the JPG.
            unlink($destination);
            $destination = $jpeg_name;
        }
        $new_image_info['lowres_filename'] = realpath($destination);

        unset($im_clone);

        // Get and return the new resized & cropped image page dimensions
        $new_image_info = array_merge($new_image_info, $this->getDimensions($new_image_info['highres_filename']));
        return $new_image_info;
    }

    /**
     * Exports a thumbnail with the given filename.
     *
     * @param string $dirname Directory where image is to be saved
     * @param string $filename Filename of image to be saved.
     * @param bool $is_spread If true, the image is cropped, revealing only the left half, for a cover preview image.
     */
    protected function exportThumbnail($dirname, $filename, $is_spread = false)
    {
        $size = [
            'width' => $is_spread ? 400 : 200,
            'height' => $is_spread ? 300 : 150
        ];

        // Reset the iterator index to 0, and clone the Imagick object.
        $im_clone = clone $this->imagick;
        $im_clone->setIteratorIndex(0);
        $im_clone->setImageFormat('png');

        // Crop and scale the image
        $im_clone->scaleImage($size['width'], $size['height'], true);

        if ($is_spread) {
            // Use only right half of the image, if the PSD represents a full spread.
            // Remember, cover pages are on the right hand side of the spread!
            $im_clone->cropImage($size['width'] / 2, $size['height'], $size['width'] / 2, 0);
        }

        prep_dir($dirname, 0777, true);
        $im_clone->setImagePage(0, 0, 0, 0);
        $im_clone->writeImage("{$dirname}/{$filename}");

        $source = "{$dirname}/{$filename}";
        $destination = "{$dirname}/" . basename($filename, 'png') . 'jpg';
        exec("convert -flatten -background white {$source} {$destination}");
        exec("rm -rf {$dirname}/{$filename}");
    }

    /**
     * Gets Imagick to open the file. This helps prevent reopening PSD documents that are already open.
     *
     * @param string $psd_file Filename of the PSD to be opened
     */
    protected function open($psd_file)
    {
        if ($this->open_file != $psd_file) {
            $this->imagick = new Imagick($psd_file);
            $this->open_file = $psd_file;
        }
    }

    /**
     * This is a quick and lightweight way to get the PSD,PNG or JPEG file dimensions, without opening the file.
     *
     * @param string $psd_file The PSD file for which width and height is to be retrieved
     *
     * @return array An array is returned containing a 'width' and 'height' key, describing the document dimensions
     *
     * @throws Exception
     */
    public function getDimensions($psd_file)
    {
        $dirname = dirname($psd_file);
        $filename = basename($psd_file);
        exec("cd {$dirname}; identify {$filename}", $psd_info_string);

        if (preg_match("/(PSD|PNG|JPEG) [\d]{1,5}x[\d]{1,5}/", $psd_info_string[0], $result)) {
            $result = preg_split('/x/', $result[0]);
            return [
                'width' => (int)preg_replace('/(PSD)|(PNG)|(JPEG) /', '', $result[0]),
                'height' => (int)$result[1]
            ];
        } else {
            // The file possibly doesn't exist, or we don't have permissions to it
            throw new Exception("Unable to read PSD properties for ${filename}");
        }
    }
}
