<?php defined('SYSPATH') or die('No direct script access.');

class Model_Calendar extends Model {

    public function get_events()
    {
        $path = Kohana::find_file('vendor', 'ZendGdata-1.11.5/library/Zend/Loader');
        // The Zend libraries don't work unless you add them to the PHP include path
        set_include_path(get_include_path().PATH_SEPARATOR.dirname(dirname($path)));
        require $path;

        Zend_Loader::loadClass('Zend_Gdata');
        Zend_Loader::loadClass('Zend_Gdata_HttpClient');
        Zend_Loader::loadClass('Zend_Gdata_Calendar');

        $gdata = new Zend_Gdata_Calendar();
        echo var_dump($gdata);
    }

}
