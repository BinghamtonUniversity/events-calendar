<form>
<?php
    foreach ($calendars as $calendar) {
        $title = rawurlencode($calendar->title);
        if (isset($_COOKIE[$title]) && $_COOKIE[$title] == 'false') {
            $status = null;
        } else {
            $status = 'checked';
        }

        echo '<label>';
        echo sprintf('<input type="checkbox" class="calendar_toggle" data-calendar="%s" %s>',
            $calendar->title,
            $status
        );
        echo $calendar->title;
        echo '</label><br/>';
    }
?>
</form>
