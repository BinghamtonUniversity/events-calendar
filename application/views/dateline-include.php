<h1 id="events-calendar-heading" style="color: #00694d; font-size: 14px; padding-left: 0px; padding-top: 10px; text-transform: none; font-family: Arial; font-weight: normal;" >UNIVERSITY CALENDAR</h1>
<ul id="events-calendar-list" style="left-index: 0px; font-family: Arial; font-weight: normal;padding-left: 20px; list-style-type: none;" >

<?php
    foreach ($feed_events as $event) {
        $formatted_date = strftime('%b %e', strtotime($event->date));
        echo "<li class=\"events-calendar-event\" style=\"color: #999999; font-size: 12px; padding-right: 10px; margin-left: -10px; font-family: Arial; font-weight: normal;\" ><strong>$formatted_date:</strong> <a style=\"color: #00694d; font-size: 12px; font-family: Arial; font-weight: normal;\" href=\"http://calendar.binghamton.edu/index.php/calendar/event/$event->permalink\">$event->title</a></li>";
    }
?>

</ul>
<p id="events-calendar-link"><a style="color: #00694d; font-size: 12px; margin-left: 0px; font-family: Arial; font-weight: normal;" href="http://calendar.binghamton.edu/">More University Events →</a></p>
