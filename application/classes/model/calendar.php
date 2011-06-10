<?php defined('SYSPATH') or die('No direct script access.');

class Model_Calendar extends ORM {

    protected $_has_many = array('events' => array());

    // Zend object for connecting to the Google API
    private $_gdata;
    private $_events = array();

    private function _load_zend()
    {
        Zend_Loader::loadClass('Zend_Gdata');
        Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
        Zend_Loader::loadClass('Zend_Gdata_HttpClient');
        Zend_Loader::loadClass('Zend_Gdata_Calendar');

        $service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
        // Pull username and password information from the config/google.php file
        $username = Kohana::config('google.username');
        $password = Kohana::config('google.password');

        $client = Zend_Gdata_ClientLogin::getHttpClient($username, $password, $service);

        $this->_gdata = new Zend_Gdata_Calendar($client);
    }

    public function get_google_events($calendar_address)
    {
        $this->_load_zend();

        $query = $this->_gdata->newEventQuery($calendar_address);
        $today = date('Y-m-d');

        $query->setUser(NULL);
        $query->setVisibility(NULL);
        $query->setProjection(NULL);
        $query->setStartMin($today);
        $query->setStartMax(date('Y-m-d', strtotime("$today +1 year")));

        try {
            $event_feed = $this->_gdata->getCalendarEventFeed($query);
        } catch (Zend_Gdata_App_Exception $e) {
            // TODO Handle failure to connect to google calendar API
            echo 'Failed: '.$calendar_address;
            echo 'Error: ' . $e->getMessage();
            return;
        }

        foreach ($event_feed as $event) {
            $event_title   = $event->title->text;
            $event_id      = $event->id->text;
            $event_content = $event->content->text;

            if (isset($event->where)) {
                $event_where = $event->where;
            } else {
                $event_where = '';
            }

            // Recurring events have an array containing multiple 'whens'
            // TODO Permalink might change if event start time changes
            foreach ($event->when as $when) {
                $date = substr($when->startTime, 0, 10);

                $event = array(
                    'date'       => $date,
                    'human_date' => strftime('%A, %B %e, %Y', strtotime($date)),
                    'start_time' => strtotime($when->startTime),
                    'end_time'   => strtotime($when->endTime),
                    'title'      => $event_title,
                    'content'    => $event_content,
                    'where'      => $event_where,
                    'address'    => $event_id,
                    'permalink'  => md5($date . $when->startTime . $event_id)
                );

                array_push($this->_events, (object) $event);
            }
        }

        return $this->_events;
    }

    public function get_google_calendars()
    {
        $this->_load_zend();

        try {
            $list_feed = $this->_gdata->getCalendarListFeed();
        } catch (Zend_Gdata_App_Exception $e) {
            // TODO Handle failure to connect to google calendar API
            echo "Error: " . $e->getMessage();
            return;
        }

        $google_calendars = array();

        foreach ($list_feed as $google_calendar) {
            // Hide the default calendar from the list
            if ($google_calendar->title != 'calendar@binghamton.edu' && $google_calendar->title != 'Pending') {
                array_push($google_calendars, $google_calendar);
            }
        }

        return $google_calendars;
    }
}
