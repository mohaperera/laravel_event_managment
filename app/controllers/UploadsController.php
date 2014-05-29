<?php

class UploadsController extends BaseController
{
    /**
     * Handles chunked file uploads.
     *
     * @return Response
     */
    public function upload()
    {
        // Create a unique upload filename, using the CSRF token and session ID.
        $unique_name = $this->getUploadFilename();
        $filename =  Config::get('tms.upload_path') . "/{$unique_name}";

        // Append the file contents just uploaded.
        file_put_contents($filename, file_get_contents("php://input"), FILE_APPEND);
    }

    /**
     * Used to determine the number of bytes uploaded for the current session + token file.
     */
    public function resume()
    {
        $unique_name = $this->getUploadFilename();
        $filename = Config::get('tms.upload_path') . "/{$unique_name}";

        if (file_exists($filename)) {
            // File exists, return the number of bytes uploaded for this file...
            return json_encode(['bytes' => filesize($filename)]);
        }

        return json_encode(['bytes' => 0]);
    }

    /**
     * Convenience method to determine upload filename from current session id and CSRF token.
     */
    protected function getUploadFilename()
    {
        return Session::getId() . "_" . Session::get('_token') . ".7z";
    }
}

