<?php defined('SYSPATH') or die('No direct script access.');

class utilities {

	//Default banner image full path
    private static $_banners = null;


    public static function getBanners() {

        if(self::$_banners !=null)
            return $this->_banners;

    	$handle = opendir('media/images/banners');
        self::$_banners = array("calendar-6.jpg");


        if ($handle !== false) {
          
            while (false !== ($entry = readdir($handle))) {
                if(preg_match('/\.jpg$/i', $entry) != 0) {
                    self::$_banners[] = $entry;
                }    
            }
            closedir($handle);
        }

        return self::$_banners;
    }
}


