<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Binghamton University - Events Calendar</title>
<link media="all" href="/css/styles.css" type="text/css" rel="stylesheet" />
<?php echo HTML::style('media/css/events.css'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="imageToolbar" content="no" />
<?php echo HTML::script('media/js/calendar.js'); ?>
<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
<script type="text/javascript">
		var pageTracker = _gat._getTracker("UA-1861349-1");
		pageTracker._trackPageview();
	</script>
</head>
<body>
<?php echo View::factory('header'); ?>
<div class="contentWidth bodyContent">
    <div class="calendar_container" style="padding: 20px 40px;">
        <div style="float: left; width: 700px;">
            <h1>Binghamton University Events Calendar</h1>
            <form id="search_form">
                <input id="search_string" type="text" class="text" style="font-size: 24px; margin: 20px 0;" value="Search Events" size="40" />
            </form>

            <div>
                <div id="calendar_view">
                <?php
                    $previous_date = null;

                    foreach ($events as $event) {
                        if ($event->date != $previous_date) {
                            if ($previous_date) {
                                echo '</div>';
                            }
                            echo '<div class="date">';
                            echo "<h3>{$event->human_date}</h3>";
                            $previous_date = $event->date;
                        }

                        if ($event->start_time) {
                            $start_time = strftime('%l:%M %p', $event->start_time);
                        } else {
                            $start_time = 'All Day';
                        }

                        echo sprintf('<p class="event" data-calendar="%s"><strong>%s</strong> <a class="event_link" data-event="%s" href="?event=%s">%s</a> (%s)</p>',
                            $event->calendar->title,
                            $start_time,
                            $event->permalink,
                            $event->permalink,
                            $event->title,
                            $event->calendar->title
                        );
                    }
                    echo '</div>';
                ?>
                </div>
            </div>
        </div>
        <div style="float: right; width: 150px;">
            <h2>View Date</h2>
            <p>(JS Calendar Here)
            <h2>Filter Events</h2>
            <p><a href="#" class="show_all">Show All</a> | <a href="#" class="hide_all">Hide All</a></p>
            <form>
               <!-- display calendar toggles -->
            </form>
        </div>
    </div>
<!-- body content -->
</div>
<?php echo View::factory('footer'); ?>
</body>
</html>
