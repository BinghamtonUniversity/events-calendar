<form>
<?php
    foreach ($calendars as $calendar) {
        if (isset($_COOKIE[$calendar->permalink]) && $_COOKIE[$calendar->permalink] == 'false') {
            $status = null;
        } else {
            $status = 'checked';
        }

        echo '<label>';
        echo sprintf('<input type="checkbox" class="calendar_toggle" data-calendar="%s" %s>',
            $calendar->permalink,
            $status
        );
        echo $calendar->title;
        echo '</label><br/>';
    }
?>
</form>
