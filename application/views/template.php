<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>

<?php
    $title = 'Binghamton University - Events Calendar';
    if (isset($extended_title)) {
        $title = $title.": ".$extended_title;
    }
    echo "<title>$title</title>";
?>

<link media="all" href="http://www.binghamton.edu/css/styles.css" type="text/css" rel="stylesheet" />
<?php echo HTML::style('media/css/events.css'); ?>
<?php echo HTML::style('media/css/jquery-ui-1.8.12.custom.css'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="" />
<meta name="Description" content="" />
</head>
<body>
<?php echo View::factory('header'); ?>
<div class="contentWidth bodyContent">
    <div id="calendar_container">
        <div id="banner" style="background-image: url('/media/images/banners/calendar-6.jpg');">
            <h1><a href="<?php echo URL::base(); ?>">Events Calendar</a></h1>
        </div>
        <div id="main_column">
            <?php include Kohana::find_file('views', $subview); ?>
        </div>
        <div id="secondary_column">
            <?php if (isset($show_datepicker)): ?>
                <div id="datepicker" class="secondary_block"></div>
            <?php endif; ?>

            <div class="secondary_block">
                <h4>Search Events</h4>
                <?php
                    echo Form::open('search', array('id' => 'search_form'));
                    echo '<p>';
                    echo Form::input('search_string', '', array('id' => 'search_string'));
                    echo Form::input('search_submit', 'Search', array('type' => 'submit', 'id' => 'search_submit'));
                    echo '</p>';
                    echo Form::close();
                ?>
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

<script src="https://www.google.com/jsapi?key=ABQIAAAA3ia0NPE98EwrkgLZHTSkgxTXO7ZdFP8GFbr4e1voZqr2tFi3GBQN00cLkqcQU9y6_jIvQSyed39Wfg"> </script>
<script> 
    //<![CDATA[
    google.load("jquery", "1.6");
    google.load("jqueryui", "1.8");
    //]]>
</script>
<?php echo HTML::script('media/js/jquery.cookie.min.js'); ?>
<?php echo HTML::script('media/js/calendar.min.js'); ?>
<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
		var pageTracker = _gat._getTracker("UA-1861349-1");
		pageTracker._trackPageview();
</script>
<script src="/inc/header-search.min.js"> </script>

</body>
</html>
