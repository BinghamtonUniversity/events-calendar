<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Feed extends Controller {

    public function action_index()
    {
        $feeds = ORM::factory('feed')
            ->find_all();

        $view = View::factory('template')
            ->bind('feeds', $feeds);

        $view->subview = 'pages/feeds';

        $this->response->body($view);
    }

    public function action_create()
    {
        $feed = ORM::factory('feed');
        $feed->title = $this->request->post('feed_title');
        $feed->save();
        $this->request->redirect('feed');
    }

    public function action_delete($feed_id)
    {
        $feed = ORM::factory('feed', $feed_id);

        $view = View::factory('template')
            ->bind('feed', $feed);

        $view->subview = 'pages/delete_feed';

        $this->response->body($view);
    }

    public function action_confirm_delete($feed_id)
    {
        $feed = ORM::factory('feed', $feed_id);
        $feed->delete();
        $this->request->redirect('feed');
    }
}
