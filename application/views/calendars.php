<form>
<?php
    foreach ($calendars as $calendar) {
        echo '<label>';
        echo sprintf('<input type="checkbox" class="calendar_toggle" data-calendar="%s" checked>',
            $calendar->title
        );
        echo $calendar->title;
        echo '</label><br/>';
    }
?>
</form>
