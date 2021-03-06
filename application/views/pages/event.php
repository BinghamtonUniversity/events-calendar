<div id="event_view">
<?php
    echo "<h1>{$event->title}</h1>";

    echo '<div class="single_event">';

    echo '<p class="event_when">';

    echo $event->human_date.' ';

    $start_time = strftime('%l:%M %p', $event->start_time);
    $end_time   = strftime('%l:%M %p', $event->end_time);

    if ($start_time == $end_time) {
        echo 'All Day';
    } else {
        echo $start_time.' to '.$end_time;
    }
    echo '</p>';

    echo '<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="binghamtonu" data-related="binghamtonu:Binghamton University">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';
    echo '<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2F'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'&amp;layout=standard&amp;show_faces=false&amp;width=450&amp;action=recommend&amp;font=verdana&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:550px; height:35px;" allowTransparency="true"></iframe>';

    if ($event->where) {
        echo "<p><strong>Location:</strong> {$event->where}</p>";
    }

    if ($event->content) {
        echo '<p class="event_content">';
        echo Text::auto_link($event->content);
        echo '</p>';
    }

    echo '</div>';
?>
</div>
