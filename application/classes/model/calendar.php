<?php defined('SYSPATH') or die('No direct script access.');

class Model_Calendar extends ORM {

    protected $_has_many = array('events' => array());


    // Zend object for connecting to the Google API
    private $_gdata;
    private $_events = array();
    private $_DSN;

    public function __construct()
    {
        parent::__construct();

        Zend_Loader::loadClass('Zend_Gdata');
        Zend_Loader::loadClass('Zend_Gdata_HttpClient');
        Zend_Loader::loadClass('Zend_Gdata_Calendar');

        $this->_gdata = new Zend_Gdata_Calendar();
    }

    public function get_google_events($calendar_address)
    {
        $query = $this->_gdata->newEventQuery();
        $today = date('Y-m-d');

        $query->setUser($calendar_address);
        $query->setStartMin($today);
        $query->setStartMax(date('Y-m-d', strtotime("$today +1 week")));

        try {
            $event_feed = $this->_gdata->getCalendarEventFeed($query);
        } catch (Zend_Gdata_App_Exception $e) {
            // TODO Handle failure to connect to google calendar API
            echo 'Error: ' . $e->getMessage();
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

}
