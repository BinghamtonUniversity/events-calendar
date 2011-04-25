<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Binghamton University - Events Calendar</title>
<link media="all" href="/css/styles.css" type="text/css" rel="stylesheet" />
<?php echo HTML::style('media/css/events.css'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<script src="https://www.google.com/jsapi?key=ABQIAAAA3ia0NPE98EwrkgLZHTSkgxTXO7ZdFP8GFbr4e1voZqr2tFi3GBQN00cLkqcQU9y6_jIvQSyed39Wfg">

</script>
<script> 
    //<![CDATA[
    google.load("jquery", "1.5.0");
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
        <div style="float: right; width: 200px;">
            <h2>View Date</h2>
            <p>(JS Calendar Here)
            <h2>Search Events</h2>
            <form id="search_form">
                <p>
                <input id="search_string" type="text" class="text" value="Search Events" />
                </p>
            </form>
            <h2>Filter Events by Category</h2>
            <p><a href="#" class="show_all">Show All</a> <a href="#" class="hide_all">Hide All</a></p>
                <!-- display calendar toggles -->
                <?php include Kohana::find_file('views', 'calendars'); ?>
        </div>
    </div>
<!-- body content -->
</div>
<?php echo View::factory('footer'); ?>
</body>
</html>
