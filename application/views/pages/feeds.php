<div style="margin-top: 20px;">
<?php
    foreach ($feeds as $feed) {
        $events = $feed->events->find_all();
        foreach ($events as $event) {
            echo $event->title;
        }
    }
?>
</div>
