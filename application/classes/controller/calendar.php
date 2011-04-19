<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Calendar extends Controller {

    private $_all_events = array();

    private function _delete_all($model)
    {
        $collection = ORM::factory($model)->find_all();

        foreach ($collection as $item) {
            $item->delete();
        }
    }

    public function action_index()
    {
        $events = ORM::factory('event')->order_by('date', 'ASC')->order_by('start_time', 'ASC')->find_all();

        foreach ($events as $event) {
            array_push($this->_all_events, $event);
        }

        $view = View::factory('template')
            ->bind('events', $this->_all_events);

        $this->response->body($view);
    }

	public function action_refresh()
	{
        $this->_delete_all('calendar');
        $this->_delete_all('event');

        $google_calendars = ORM::factory('calendar')->get_google_calendars();

        foreach ($google_calendars as $google_calendar) {
            $calendar = ORM::factory('calendar');
            $calendar->title = $google_calendar->title;
            $calendar->address = $google_calendar->link[0]->href;
            $calendar->save();
        }

        $calendars = ORM::factory('calendar')->find_all();

        foreach ($calendars as $calendar) {
            $google_events = $calendar->get_google_events($calendar->address);

            foreach ($google_events as $google_event) {
                $event = ORM::factory('event');

                // Associate the event with the current calendar
                $event->calendar = $calendar;

                // Map the properties of the Google event to our local copy
                foreach ($google_event as $name => $value) {
                    $event->$name = $value;
                }

                $event->save();
            }
        }

        //$this->request->redirect('calendar');
	}

    public function action_calendars()
    {
        $calendar = ORM::factory('calendar');
        $calendar->get_google_calendars();
    }
}
