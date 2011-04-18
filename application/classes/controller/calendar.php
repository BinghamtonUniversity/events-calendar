<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Calendar extends Controller {
        //'binghamton.edu_o7b1rg2se0ga1lerca6tvljc48@group.calendar.google.com', // Alumni
        ////'binghamton.edu_g45lehgeufuj72d6phu2ibnfjc@group.calendar.google.com', // Career Events
        ////'binghamton.edu_n9r81o1pkv9r7rk66shkjqiuss@group.calendar.google.com', // Conferences
        ////'binghamton.edu_1dl9m9g6f0sltcvofmrmh49vh0@group.calendar.google.com', // Courses/Workshops
        ////'binghamton.edu_c7pd7i7nhgck5t7pr1pip3ikp8@group.calendar.google.com', // Cultural Celebrations
        ////'binghamton.edu_f5vbuodsc8ea78t9cnp0kt3oh8@group.calendar.google.com', // Exhibits
        ////'binghamton.edu_v16iftj0t0svicuetqru282lcc@group.calendar.google.com', // Films
        ////'binghamton.edu_j00r695kpl25kntqr9d5kj4jcc@group.calendar.google.com', // General Events
        ////'binghamton.edu_p9qnpk1omu356d82d48jlfoi9g@group.calendar.google.com', // Health & Recreation
        ////'binghamton.edu_3ihmklvo80o1v2n7m0s5qrbdcg@group.calendar.google.com', // On Stage
        ////'binghamton.edu_5jl3saj7knuuicn8h725n5gdig@group.calendar.google.com', // Speakers
        ////'binghamton.edu_nlii8brlqjr4n1i4h69vqk0v54@group.calendar.google.com', // Sports
        ////'binghamton.edu_ph8ad80onheqtrk4splr2i0eu0@group.calendar.google.com', // Student Events
        //'usa@holiday.calendar.google.com',

    public function action_index()
    {
    }

	public function action_refresh()
	{
        $calendars = ORM::factory('calendar');
        $calendars = $calendars->find_all();

        foreach ($calendars as $calendar) {
            echo $calendar->title.'<br/>';

            $events = $calendar->events->find_all();

            foreach ($events as $event) {
                $event->delete();
            }

            $google_events = $calendar->get_google_events($calendar->address);

            foreach ($google_events as $google_event) {
                $event = ORM::factory('event');
                // Associate the event with the current calendar
                $event->calendar = $calendar;

                foreach ($google_event as $name => $value) {
                    $event->$name = $value;
                }

                $event->save();
            }

            $events = $calendar->events->find_all();

            foreach ($events as $event) {
                echo $event->title.'<br/>';
            }
        }
	}

}
