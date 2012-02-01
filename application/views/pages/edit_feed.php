<div style="margin-top: 20px;">
<?php
    echo "<h3>Editing Feed: {$feed->title}</h3>";

    echo "<p><em>Click event titles to add or remove them from the feed.</em></p>";

    echo sprintf('<p><a href="%s">&larr; Back to Feed List</a></p>',
        URL::site('feed')
    );

    echo '<h4>Events in Feed:</h4>';
    foreach ($feed_events as $event) {
        echo sprintf('<a href="%s">',
            URL::site('feed/delete_event/'.$feed->id.'/'.$event->permalink)
        );
        echo strftime('%Y-%m-%d', strtotime($event->date)).' ';
        echo $event->title.'</a><br/>';
    }

    echo '<h4 style="margin-top: 20px;">Available Events:</h4>';
    foreach ($available_events as $event) {
        echo sprintf('<a href="%s">',
            URL::site('feed/add_event/'.$feed->id.'/'.$event->permalink)
        );
        echo strftime('%Y-%m-%d', strtotime($event->date)).' ';
        echo $event->title.'</a><br/>';
    }
?>
</div>
