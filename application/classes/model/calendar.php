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
        $query->setStartMax(date('Y-m-d', strtotime("$today +1 week")));

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

            // Recurring events have an array containing multiple 'whens'
            foreach ($event->when as $when) {
                $date = substr($when->startTime, 0, 10);

                if (strlen($when->startTime) > 10) {
                    $start_time = strtotime(substr($when->startTime, 11, 5));
                    $end_time   = strtotime(substr($when->endTime, 11, 5));
                } else {
                    $start_time = null;
                    $end_time   = null;
                }

                $event = array(
                    'date'       => $date,
                    'human_date' => strftime('%A, %B %e, %Y', strtotime($date)),
                    'start_time' => $start_time,
                    'end_time'   => $end_time,
                    'title'      => $event_title,
                    'content'    => $event_content,
                    'address'    => $event_id,
                    'permalink'  => hash('crc32', $date . $start_time . $event_id)
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
            if ($google_calendar->title != 'web@binghamton.edu') {
                array_push($google_calendars, $google_calendar);
            }
        }

        return $google_calendars;
    }
}
