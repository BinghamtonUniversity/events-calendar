<?php
    if ($event->start_time) {
        $start_time = strftime('%l:%M %p', $event->start_time);
    } else {
        $start_time = 'All Day';
    }

    echo sprintf('<div class="event" data-calendar="%s">', $event->calendar->title);
    echo '<p class="event_header">';
    echo sprintf('<a class="event_link" data-event="%s" href="%s">%s</a>',
        $event->permalink,
        URL::site('calendar/event/'.$event->permalink),
        $event->title
    ).'<br/>';
    echo $event->human_date.' '.$start_time;
    echo '</p>';
    if ($event->content) {
        echo '<p class="event_content">';
        echo $event->content;
        echo '</p>';
    }
    echo '</div>';
?>
