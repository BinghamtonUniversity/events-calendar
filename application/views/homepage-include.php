<h1><span class="grey">UNIVERSITY</span> CALENDAR<!-- <img class="rssIcon" src="http://www2.binghamton.edu/inside/images/rss-logo.png" _mce_src="http://www2.binghamton.edu/inside/images/rss-logo.png" alt="RSS feed logo" width="16" height="16" /> --><strong></strong><strong></strong></h1>
<ul>

<?php
    foreach ($feed_events as $event) {
        $formatted_date = strftime('%b. %e', strtotime($event->date));
        echo "<li><strong>$formatted_date:</strong> <a href=\"http://calendar.binghamton.edu/index.php/calendar/event/$event->permalink\">$event->title</a></li>";
    }
?>

</ul>
<p><a href="http://calendar.binghamton.edu/">More University Events →</a></p>
