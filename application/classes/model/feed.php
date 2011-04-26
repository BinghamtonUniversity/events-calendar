<?php defined('SYSPATH') or die('No direct script access.');

class Model_Feed extends ORM {

    protected $_has_many = array(
        'events' => array(
            'model' => 'event',
            'through' => 'feeds_events',
        ),
    );

}
