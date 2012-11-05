<h1 id="events-calendar-heading"><span class="grey">UNIVERSITY</span> CALENDAR</h1>
<ul id="events-calendar-list">

<?php
    foreach ($feed_events as $event) {
        $formatted_date = strftime('%b %e', strtotime($event->date));
        echo "<li class=\"events-calendar-event\"><strong>$formatted_date:</strong> <a href=\"http://calendar.binghamton.edu/index.php/calendar/event/$event->permalink\">$event->title</a></li>";
    }
?>

</ul>
<p id="events-calendar-link"><a href="http://calendar.binghamton.edu/">More University Events →</a></p>
