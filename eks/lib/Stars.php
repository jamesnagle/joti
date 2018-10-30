<?php 
namespace Eks;

class Stars {

    public static function one($half = null) { 
        return sprintf('<p>%s</p>', self::build(1, $half));
    }
    public static function two($half = null) { 
        return sprintf('<p>%s</p>', self::build(2, $half));
    } 
    public static function three($half = null) { 
        return sprintf('<p>%s</p>', self::build(3, $half));
    }
    public static function four($half = null) { 
        return sprintf('<p>%s</p>', self::build(4, $half));
    }
    public static function five() { 
        return sprintf('<p>%s</p>', self::build(5));
    }                  
    protected static function star() {
        return '<i class="fas fa-star"></i>';
    }
    protected static function half() {
        return '<i class="fas fa-star-half"></i>';
    }
    protected static function build($cnt, $half = null) {
        $stars = '';
        for ($i=0;$i<$cnt;$i++) {
            $stars .= self::star();
        }
        if ($half && $half === '.5') {
            $stars .= self::half();
        }
        return $stars;
    }
}