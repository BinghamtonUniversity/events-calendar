<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller {

	public function action_index()
	{
        $calendar = new Model_Calendar();
		//$this->response->body('hello, world!');
	}

} // End Welcome
