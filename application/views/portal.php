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
<style type="text/css">
    body { background: none; width: 670px; }
    .contentWidth { margin: 0; width: 670px; }
    div#calendar_container { padding: 10px; }
    div#main_column { width: 400px; }
    div#list_view { width: 400px; padding-right: 12px; }
</style>
</head>
<body>
<div class="contentWidth bodyContent">
    <div id="calendar_container">
        <div id="main_column">
            <?php include Kohana::find_file('views', $subview); ?>
        </div>
        <div id="secondary_column">
            <?php if (isset($show_datepicker)): ?>
                <div id="datepicker" class="secondary_block"></div>
            <?php endif; ?>

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

<script src="https://www.google.com/jsapi?key=ABQIAAAA3ia0NPE98EwrkgLZHTSkgxTXO7ZdFP8GFbr4e1voZqr2tFi3GBQN00cLkqcQU9y6_jIvQSyed39Wfg"> </script>
<script> 
    //<![CDATA[
    google.load("jquery", "1.6");
    google.load("jqueryui", "1.8");
    //]]>
</script>
<?php echo HTML::script('media/js/jquery.cookie.min.js'); ?>
<?php echo HTML::script('media/js/calendar_portal.js'); ?>
</body>
</html>
