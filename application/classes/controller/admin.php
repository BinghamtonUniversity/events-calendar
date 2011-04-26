<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller {

    public function action_index()
    {
        $view = View::factory('template');

        $view->subview = 'pages/feeds';

        $this->response->body($view);
    }
}
