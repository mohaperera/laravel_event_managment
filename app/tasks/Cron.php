<?php
namespace tasks;

class Cron
{
    /**
    * This class is used for Cron Job batch Processing
    *
    * @param $arguments
    * @return mixed
    */
    public function run($arguments)
    {
        destroy($arguments);
        cronDelete($arguments);
    }
    public function destroy($dir)
    {
        $mydir = opendir($dir);
        while (false !== ($file = readdir($mydir))) {

            if ($file != "." && $file != "..") {
                chmod($dir.$file, 0777);
                if (is_dir($dir.$file)) {
                    chdir('.');
                    destroy($dir.$file.'/');
                    rmdir($dir.$file) or die("couldn't delete $dir$file<br />");
                } else {
                    unlink($dir.$file) or die("couldn't delete $dir$file<br />");

                }
            }
        }
        closedir($mydir);
    }
     /**
     * This function is used for Deleting files in given interval
     *
     * @param $path
     * @return ture
     */

    public function cronDelete($path)
    {
        if (is_dir($path) === true) {

            $files = array_diff(scandir($path), array('.', '..'));

            foreach ($files as $file) {
                cronDelete(realpath($path) . '/' . $file);
            }

            return rmdir($path);
        } elseif (is_file($path) === true) {
            return unlink($path);
        }

        return false;
    }
}
