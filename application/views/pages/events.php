<h1>Binghamton University Events Calendar</h1>

<?php

$previous_date = null;

foreach ($events as $event) {
    if ($event->date != $previous_date) {
        if ($previous_date) {
            echo '</div>';
        }

		if (isset($display_dates[$event->date])) {
			$display = '';
		} else {
			$display = 'display: none;';
		}

		echo sprintf('<div class="date" style="%s">', $display);
        if ($event->date == date('Y-m-d')) {
            echo "<h3>{$event->human_date} (Today)</h3>";
        } else {
            echo "<h3>{$event->human_date}</h3>";
        }
        $previous_date = $event->date;
    }

    $start_time = strftime('%l:%M %p', $event->start_time);
    $end_time   = strftime('%l:%M %p', $event->end_time);

    if ($start_time == $end_time) {
        $start_time = 'All Day';
    }

    if (Arr::get($_COOKIE, $event->calendar->permalink, false) == 'false') {
		$display = 'display: none;';
	} else {
		$display = '';
	}

	echo sprintf('<div class="event" data-calendar="%s" style="%s">',
		$event->calendar->permalink,
		$display
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
