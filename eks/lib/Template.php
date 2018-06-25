<?php 
namespace Eks;

class Template {
    public static function load(string $filename)
    {
        $file_path = VIEWS_DIRECTORY . $filename;
        if (file_exists($file_path)) {
            include $file_path;
        } else {
            throw new \Exception("No {$filename} found at {$file_path}");
        }
    }
}