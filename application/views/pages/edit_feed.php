<div style="margin-top: 20px;">
<?php
    echo "<h3>Editing: {$feed->title}</h3>";

    $feed_events = $feed->events->order_by('date')->find_all();

    echo '<h4>Events in Feed</h4>';
    foreach ($feed_events as $event) {
        echo strftime('%Y-%m-%d', strtotime($event->date)).' ';
        echo $event->title;
    }

    echo '<h4>Available Events</h4>';
    foreach ($events as $event) {
        echo sprintf('<a href="%s">',
            URL::site('feed/add_event/'.$feed->id.'/'.$event->permalink)
        );
        echo strftime('%Y-%m-%d', strtotime($event->date)).' ';
        echo '</a>';
        echo $event->title.'<br/>';
    }
?>
</div>
