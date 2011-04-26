<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Binghamton University - Events Calendar</title>
<link media="all" href="/css/styles.css" type="text/css" rel="stylesheet" />
<?php echo HTML::style('media/css/events.css'); ?>
<?php echo HTML::style('media/css/jquery-ui-1.8.12.custom.css'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<script src="https://www.google.com/jsapi?key=ABQIAAAA3ia0NPE98EwrkgLZHTSkgxTXO7ZdFP8GFbr4e1voZqr2tFi3GBQN00cLkqcQU9y6_jIvQSyed39Wfg">

</script>
<script> 
    //<![CDATA[
    google.load("jquery", "1.5.2");
    google.load("jqueryui", "1.8.12");
    //]]>
</script>
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
    <div id="calendar_container">
        <h1>Binghamton University Events Calendar</h1>
        <div id="main_column">

            <div>
                <div id="calendar_view">
                    <?php include Kohana::find_file('views', $subview); ?>
                </div>
            </div>
        </div>
        <div id="secondary_column">
            <div id="datepicker" class="secondary_block"></div>
            <div class="secondary_block">
                <h4>Search Events</h4>
                <form id="search_form">
                    <p>
                    <input id="search_string" type="text" class="text" value="Search Events" />
                    </p>
                </form>
            </div>
            <?php if (isset($calendars)): ?>
            <div class="secondary_block">
                <h4>Filter Events by Category</h4>
                <div class="calendars_show_buttons" id="calendars_show_all">Show All</div>
                <div class="calendars_show_buttons" id="calendars_hide_all">Hide All</div>
                <div style="clear: both;"></div>
                <!-- display calendar toggles -->
                <?php include Kohana::find_file('views', 'calendars'); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
<!-- body content -->
</div>
<?php echo View::factory('footer'); ?>
</body>
</html>
