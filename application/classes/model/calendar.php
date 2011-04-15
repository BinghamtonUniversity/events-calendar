<?php defined('SYSPATH') or die('No direct script access.');

class Model_Calendar extends Model {

    private $_CALENDAR_ADDRESSES = array(
        'binghamton.edu_o7b1rg2se0ga1lerca6tvljc48@group.calendar.google.com', // Alumni
        //'binghamton.edu_g45lehgeufuj72d6phu2ibnfjc@group.calendar.google.com', // Career Events
        //'binghamton.edu_n9r81o1pkv9r7rk66shkjqiuss@group.calendar.google.com', // Conferences
        //'binghamton.edu_1dl9m9g6f0sltcvofmrmh49vh0@group.calendar.google.com', // Courses/Workshops
        //'binghamton.edu_c7pd7i7nhgck5t7pr1pip3ikp8@group.calendar.google.com', // Cultural Celebrations
        //'binghamton.edu_f5vbuodsc8ea78t9cnp0kt3oh8@group.calendar.google.com', // Exhibits
        //'binghamton.edu_v16iftj0t0svicuetqru282lcc@group.calendar.google.com', // Films
        //'binghamton.edu_j00r695kpl25kntqr9d5kj4jcc@group.calendar.google.com', // General Events
        //'binghamton.edu_p9qnpk1omu356d82d48jlfoi9g@group.calendar.google.com', // Health & Recreation
        //'binghamton.edu_3ihmklvo80o1v2n7m0s5qrbdcg@group.calendar.google.com', // On Stage
        //'binghamton.edu_5jl3saj7knuuicn8h725n5gdig@group.calendar.google.com', // Speakers
        //'binghamton.edu_nlii8brlqjr4n1i4h69vqk0v54@group.calendar.google.com', // Sports
        //'binghamton.edu_ph8ad80onheqtrk4splr2i0eu0@group.calendar.google.com', // Student Events
        'usa@holiday.calendar.google.com',
    );

    // Zend object for connecting to the Google API
    private $_gdata;
    private $_events = array();

    public function __construct()
    {
        $path = Kohana::find_file('vendor', 'ZendGdata-1.11.2/library/Zend/Loader');
        // The Zend libraries don't work unless you add them to the PHP include path
        set_include_path(get_include_path().PATH_SEPARATOR.dirname(dirname($path)));
        require $path;

        Zend_Loader::loadClass('Zend_Gdata');
        Zend_Loader::loadClass('Zend_Gdata_HttpClient');
        Zend_Loader::loadClass('Zend_Gdata_Calendar');

        $this->_gdata = new Zend_Gdata_Calendar();

        $this->_getGoogleEvents();
        //$this->_printEventList($this->_events);
    }

    private function _getGoogleEvents()
    {
        $query = $this->_gdata->newEventQuery();
        $today = date('Y-m-d');

        foreach ($this->_CALENDAR_ADDRESSES as $calendar_address) {
            $query->setUser($calendar_address);
            $query->setStartMin($today);
            $query->setStartMax(date('Y-m-d', strtotime("$today +1 week")));

            try {
                $event_feed = $this->_gdata->getCalendarEventFeed($query);
            } catch (Zend_Gdata_App_Exception $e) {
                // TODO Handle failure to connect to google calendar API
                echo 'Error: ' . $e->getMessage();
            }

            $calendar_title = $event_feed->title->text;

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
                        'calendar'   => $calendar_title,
                        'address'    => $event_id,
                        'permalink'  => hash('crc32', $date . $start_time . $event_id)
                    );

                    array_push($this->_events, $event);
                }
            }
        }

        echo json_encode($this->_events);
    }

    private function _printEventList($events)
    {
        $previous_date = null;

        foreach ($events as $event) {
            if ($event['date'] != $previous_date) {
                if ($previous_date) {
                    echo '</div>';
                }
                echo '<div class="date">';
                echo "<h3>{$event['human_date']}</h3>";
                $previous_date = $event['date'];
            }

            if ($event['start_time']) {
                $start_time = strftime('%l:%M %p', $event['start_time']);
            } else {
                $start_time = 'All Day';
            }

            echo sprintf(
                '<p class="event" data-calendar="%s"><strong>%s</strong> <a class="event_link" data-event="%s" href="?event=%s">%s</a> (%s)</p>',
                $event['calendar'],
                $start_time,
                $event['permalink'],
                $event['permalink'],
                $event['title'],
                $event['calendar']
                );
        }
        echo '</div>';
    }

}
