<?php defined('SYSPATH') or die('No direct script access.');

class Model_Event extends ORM {

    protected $_primary_key = 'permalink';

    protected $_belongs_to = array('calendar' => array());

    protected $_has_many = array(
        'feeds' => array(
            'model'   => 'feed',
            'through' => 'feeds_events',
        ),
    );

}
