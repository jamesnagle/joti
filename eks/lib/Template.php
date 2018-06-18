<?php 
namespace Template;

class Template {
    public static function load(string $filename)
    {
        $file_path = PUBLIC_DIRECTORY . $filename;
        if (file_exists($file_path)) {
            include $file_path;
        } else {
            throw new \Exception("No {$filename} found at {$file_path}");
        }
    }
}