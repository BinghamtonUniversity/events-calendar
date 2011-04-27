<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Feed extends Controller {

    private function _prepare_event($feed_event)
    {
        $event = new stdClass;
        $event->title      = $feed_event->title;
        $event->date       = $feed_event->date;
        $event->start_time = $feed_event->start_time;
        $event->end_time   = $feed_event->end_time;
        $event->permalink  = $feed_event->permalink;
        $event->content    = $feed_event->content;

        return $event;
    }

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

        //TODO delate related entries from feeds_events table
    }

    public function action_edit($feed_id)
    {
        $feed        = ORM::factory('feed', $feed_id);
        $feed_events = $feed->events->order_by('date')->find_all()->as_array();
        $events      = ORM::factory('event')->order_by('date')->order_by('start_time')->find_all()->as_array();

        // Remove events that are currently in the feed from the list of available events
        foreach ($feed_events as $event) {
            $key = array_search($event, $events);
            unset($events[$key]);
        }

        $view = View::factory('template')
            ->bind('feed', $feed)
            ->bind('feed_events', $feed_events)
            ->bind('feed_events_json', $feed_events_json)
            ->bind('available_events', $events);

        $view->subview = 'pages/edit_feed';

        $this->response->body($view);
    }

    public function action_add_event($feed_id, $event_permalink)
    {
        $feed = ORM::factory('feed', $feed_id);
        $feed->add('events', $event_permalink);
        $this->request->redirect('feed/edit/'.$feed_id);
    }

    public function action_delete_event($feed_id, $event_permalink)
    {
        $feed = ORM::factory('feed', $feed_id);
        $feed->remove('events', $event_permalink);
        $this->request->redirect('feed/edit/'.$feed_id);
    }

    // Output a JSON-encoded version of the specified feed
    public function action_json($feed_id)
    {
        $feed             = ORM::factory('feed', $feed_id);
        $feed_events      = $feed->events->order_by('date')->find_all()->as_array();
        $feed_events_json = array();

        foreach ($feed_events as $event) {
            array_push($feed_events_json, $this->_prepare_event($event));
        }

        echo json_encode($feed_events_json);
    }
}
