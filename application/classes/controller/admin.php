<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller {

    public function action_index()
    {
        $feeds = ORM::factory('feed')
            ->find_all();

        $view = View::factory('template')
            ->bind('feeds', $feeds);

        $view->subview = 'pages/feeds';

        $this->response->body($view);
    }
}
