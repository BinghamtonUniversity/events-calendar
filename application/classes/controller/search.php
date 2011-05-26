<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends Controller {

    public function action_index()
    {
        $search_string = Arr::get($this->request->post(), 'search_string', '');

        if ($search_string == '') {
            $this->request->redirect('calendar');
        }

        $events = ORM::factory('event')
            ->where('title', 'LIKE', "%${search_string}%")
            ->or_where('content', 'LIKE', "%${search_string}%")
            ->find_all();

        if ($events->count() > 0) {
            $view = View::factory('template')
                ->bind('search_string', $search_string)
                ->bind('events', $events)
                ->set('extended_title', 'Search Results');

            $view->subview = 'pages/search';
        } else {
            $view = View::factory('template')
                ->bind('search_string', $search_string)
                ->set('extended_title', 'No Match Found');

            $view->subview = 'pages/no_results';
        }

        $this->response->body($view);
    }

}
