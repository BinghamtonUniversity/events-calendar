<?php
$previous_date = null;

foreach ($events as $event) {
    if ($event->date != $previous_date) {
        if ($previous_date) {
            echo '</div>';
        }
        echo '<div class="date">';
        echo "<h3>{$event->human_date}</h3>";
        $previous_date = $event->date;
    }

    if ($event->start_time) {
        $start_time = strftime('%l:%M %p', $event->start_time);
    } else {
        $start_time = 'All Day';
    }

    echo sprintf('<p class="event" data-calendar="%s"><strong>%s</strong> <a class="event_link" data-event="%s" href="%s">%s</a> (%s)</p>',
        $event->calendar->title,
        $start_time,
        $event->permalink,
        URL::site('calendar/event/'.$event->permalink),
        $event->title,
        $event->calendar->title
    );
}
echo '</div>';
?>
