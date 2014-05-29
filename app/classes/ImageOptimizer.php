<?php

use Symfony\Component\Finder\Finder;

class ImageOptimizer
{

    public static function optimize($path)
    {
        Log::useFiles(storage_path() . "/logs/tms.log");
        Log::info("Running image optimizer");

        $failed_count = $crushed_count = 0;
        $finder = new Finder();
        $files = $finder->files()->name('/\.(png)|(jpg)$/')->in($path);
        Log::info("Finder found {$finder->count()} files to process...");

        foreach ($files as $file) {
            Log::debug("Optimizing " . $file->getFilename());

            $source = "{$path}/{$file->getFilename()}";
            $destination = "{$path}/{$file->getFilename()}";
            $output = [];
            $return_var = 0;

            $extension = pathinfo($source, PATHINFO_EXTENSION);
            if ($extension == 'png') {
                exec("pngcrush -q -brute -rem alla -ow {$source}", $output, $return_var);
            } elseif ($extension == 'jpg') {
                exec("jpegoptim -f -m60 -o {$source}", $output, $return_var);
            } else {
                throw new Exception("{$extension} file extension is not implemented!");
            }

            if ($return_var != 0 || !file_exists($destination)) {
                // phpcrush failed for this file, delete it and increment the error count.
                $failed_count++;
                $failed_filename = basename($destination);
                Log::error("{$failed_filename} failed to optimize.");
            } else {
                $crushed_count++;
            }
        }

        Log::info("Optimized {$crushed_count} files, {$failed_count} files failed.");
    }

}