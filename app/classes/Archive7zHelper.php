<?php

class Archive7zHelper
{
    /**
     * This function is used for extracting uploaded 7-zip files.
     */
    public static function extract($source)
    {
        if (`which 7z` == null) {
            throw new Exception("Please check that 7z is installed and available on the environment path!");
        };

        $upload_path = Config::get('tms.upload_path');
        $destination = "{$upload_path}/" . basename($source, '.7z');

        // Wipe the destination if it exists
        if (file_exists($destination)) {
            exec("rm -rf {$destination}");
        }

        // Extract the archive
        $result = shell_exec("7z e {$source} -o{$destination}");

        if (is_null($result)) {
            throw new Exception("An error occurred trying to extract the uploaded archive!");
        }

        return $destination;
    }
}
