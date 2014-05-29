<?php

if (!function_exists('slugify')) {

    /**
     * Mutates the given $name to be lowercased, hyphens replaced with underscores. Only alphanumeric characters are
     * kept in the resulting string, the rest are stripped.
     *
     * @param string $name The text to be cleaned up.
     *
     * @return string The formatted string is returned.
     */
    function slugify($name)
    {
        $result = strtolower($name);
        $result = preg_replace('/-/', '_', $result);
        $result = preg_replace('/[^a-z0-9]/', '', $result);
        return trim($result);
    }

    /**
     * Checks if the given path exists, if not, creates it recursively. Works the same as mkdir, except, doesn't throw
     * a warning if the path already exists.
     */
    function prep_dir($pathname, $mode, $recursive)
    {
        if (file_exists($pathname)) {
            return;
        }
        mkdir($pathname, $mode, $recursive);
    }

}