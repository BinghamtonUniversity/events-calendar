<div style="margin-top: 20px;">
<?php
    echo "<h3>Editing: {$feed->title}</h3>";

    echo '<h4>Events in Feed</h4>';
    foreach ($feed_events as $event) {
        echo sprintf('<a href="%s">',
            URL::site('feed/delete_event/'.$feed->id.'/'.$event->permalink)
        );
        echo strftime('%Y-%m-%d', strtotime($event->date)).' ';
        echo $event->title.'</a><br/>';
    }

    echo '<h4>Available Events</h4>';
    foreach ($available_events as $event) {
        echo sprintf('<a href="%s">',
            URL::site('feed/add_event/'.$feed->id.'/'.$event->permalink)
        );
        echo strftime('%Y-%m-%d', strtotime($event->date)).' ';
        echo $event->title.'</a><br/>';
    }
?>
</div>
