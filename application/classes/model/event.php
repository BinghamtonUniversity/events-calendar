<?php defined('SYSPATH') or die('No direct script access.');

class Model_Event extends ORM {

    protected $_belongs_to = array('calendar' => array());

}
