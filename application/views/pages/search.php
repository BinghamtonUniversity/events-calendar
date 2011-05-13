<h2>Search Results</h2>
<?php

$previous_date = null;

foreach ($events as $event) {
    if ($event->date != $previous_date) {
        if ($previous_date) {
            echo '</div>';
        }

        echo '<div class="date">';

        if ($event->date == date('Y-m-d')) {
            echo "<h3>{$event->human_date} (Today)</h3>";
        } else {
            echo "<h3>{$event->human_date}</h3>";
        }

        $previous_date = $event->date;
    }

    if ($event->start_time) {
        $start_time = strftime('%l:%M %p', $event->start_time);
    } else {
        $start_time = 'All Day';
    }

	echo sprintf('<div class="event" data-calendar="%s">',
		$event->calendar->permalink
	);

    echo '<p class="event_header">';
    echo '<span style="float: right;">'.$start_time.'</span>';
    echo '<span class="event_title">';
    echo sprintf('<a class="event_link" data-event="%s" href="%s">%s</a>',
        $event->permalink,
        URL::site('calendar/event/'.$event->permalink),
        $event->title
    );
    echo '</span>';
    echo '</p>';
    if ($event->content) {
        echo '<p class="event_content">';
        echo $event->content;
        echo '</p>';
    }
    echo '<p class="event_calendar">';
    echo '<em>'.$event->calendar->title.'</em>';
    echo '</p>';
    echo '</div>';
}

echo '</div>';

?>
