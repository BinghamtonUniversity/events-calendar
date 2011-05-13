<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Calendar extends Controller {

    // Helper function for clearing out local caches
    private function _delete_all($model)
    {
        $collection = ORM::factory($model)->find_all();

        foreach ($collection as $item) {
            $item->delete();
        }

        // Reset MySQL auto_increment values
        $query  = DB::query(NULL, "ALTER TABLE {$model}s AUTO_INCREMENT=0");
        $query->execute();
    }

    public function action_index()
    {
        $events = ORM::factory('event')
            ->order_by('date', 'ASC')
            ->order_by('start_time', 'ASC')
            ->find_all();

        $calendars = ORM::factory('calendar')
            ->order_by('title', 'ASC')
            ->find_all();

        // Cookies are used to track the status of the calendar toggle checkboxes
        // and maintain state between client and server. Set them to true by default
        foreach ($calendars as $calendar) {
            setcookie($calendar->permalink, Arr::get($_COOKIE, $calendar->permalink, 'true'), 0, '/');
        }

        foreach ($events as $event) {
            if (Arr::get($_COOKIE, $event->calendar->permalink, 'true') == 'true') {
                $display_dates[$event->date] = true;
            }
        }

        $view = View::factory('template')
            ->set('show_datepicker', true)
            ->bind('events', $events)
            ->bind('calendars', $calendars)
            ->bind('display_dates', $display_dates);

        $view->subview = 'pages/events';

        $this->response->body($view);
    }

    // Display a list of events starting at a specified future date
    public function action_show($start_date)
    {
        $events = ORM::factory('event')
            ->where('date', '>=', $start_date)
            ->order_by('date', 'ASC')
            ->order_by('start_time', 'ASC')
            ->find_all();

        foreach ($events as $event) {
            if (Arr::get($_COOKIE, $event->calendar->permalink, 'true') == 'true') {
                $display_dates[$event->date] = true;
            }
        }

        $view = View::factory('pages/events')
            ->bind('events', $events)
            ->bind('display_dates', $display_dates);

        $this->response->body($view);
    }

    // Display details for a specific event
    public function action_event($id = null)
    {
        $event = ORM::factory('event', $id);

        if ($event->loaded()) {
            $view = View::factory('template')
                ->bind('event', $event);

            $view->subview = 'pages/event';

            $this->response->body($view);
        }
    }

    // Retrieve and cache calendar and event information from Google Calendar
    public function action_refresh()
    {
        // Change this to only delete cached date following a succesful call to Google
        $this->_delete_all('calendar');
        $this->_delete_all('event');

        $google_calendars = ORM::factory('calendar')->get_google_calendars();

        foreach ($google_calendars as $google_calendar) {
            $calendar = ORM::factory('calendar');
            $calendar->title     = $google_calendar->title;
            $calendar->address   = $google_calendar->link[0]->href;
            $calendar->permalink = md5($calendar->address);
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

        $this->request->redirect('calendar');
    }

}
