<?php defined('SYSPATH') or die('No direct script access.');

class Model_Utilities extends Model {

	//Default banner image full path
    private $_banners = null;


    public function getBanners() {

        if($this->_banners !=null)
            return $this->_banners;

    	$handle = opendir('media/images/banners');
        $this->_banners = array("calendar-6.jpg");


        if ($handle !== false) {
          
            while (false !== ($entry = readdir($handle))) {
                if(preg_match('/\.jpg$/i', $entry) != 0) {
                    $this->_banners[] = $entry;
                }    
            }
            closedir($handle);
        }

        return $this->_banners;
    }
}


