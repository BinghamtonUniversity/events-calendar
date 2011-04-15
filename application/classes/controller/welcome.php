<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller {

	public function action_index()
	{
        $calendar = new Model_Calendar();
        $calendar->get_events();
		//$this->response->body('hello, world!');
	}

} // End Welcome
