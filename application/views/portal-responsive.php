<!DOCTYPE html><html><head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?php
        $title = 'Binghamton University - Events Calendar';
        if (isset($extended_title)) {
            $title = $title.": ".$extended_title;
        }
        echo "<title>$title</title>";
    ?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="apple-itunes-app" content="app-id=375487694">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="Keywords" content="Binghamton, Binghamton University, State University of New York, SUNY Binghamton, SUNY B, BU, Engineering, Nursing, Management, Computer Science, Education, Human Development, Harpur College of Arts and Sciences, Research">
   <meta name="Description" content="Binghamton University, SUNY doctoral research university for 14,600 students in beautiful upstate New York; 140 plus undergraduate and graduate degrees in arts and sciences, nursing, education and human development, management, engineering and applied science">
    <?php include("http://www.binghamton.edu/_resources/includes/headcode.inc"); ?>
    <?php echo HTML::style('media/css/events-responsive.css'); ?>
    <?php echo HTML::style('media/css/jquery-ui-1.8.12.custom.css'); ?>
    <style type="text/css">
        html { background: none; padding: 20px; }
        body { background: none; width: 700px; }
        div#calendar_container { padding: 10px; }
    </style>
</head>
<body>
   <div id="contentWhite">
      <div id="content">
         <div id="secondaryContent" class="minimal">
            <column id="content">

                  <nav id="leftNav">
                      <?php if (isset($show_datepicker) && $show_datepicker): ?>
                          <div id="datepicker" class="secondary_block"></div>
                      <?php endif; ?>

                      <div class="secondary_block">
                          <h3>Search Events</h4>
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
                              <h3>Filter Events by Category</h4>
                              <div class="calendars_show_buttons" id="calendars_show_all">Show All</div>
                              <div class="calendars_show_buttons" id="calendars_hide_all">Hide All</div>
                              <div style="clear: both;"></div>
                              <!-- display calendar toggles -->
                              <?php include Kohana::find_file('views', 'calendars'); ?>
                          </div>
                      <?php endif; ?>
                  </nav>
                  <div id="secondaryContent">
                      <?php include Kohana::find_file('views', $subview); ?>
                  </div>

            </column>
         </div>
         <div class="clear"><span style="display: none;"></span></div>
      </div>
   </div>
    <script src="https://www.google.com/jsapi?key=ABQIAAAA3ia0NPE98EwrkgLZHTSkgxTXO7ZdFP8GFbr4e1voZqr2tFi3GBQN00cLkqcQU9y6_jIvQSyed39Wfg"> </script>
    <script> 
        //<![CDATA[
        google.load("jquery", "1.6");
        google.load("jqueryui", "1.8");
        //]]>
    </script>
    <?php echo HTML::script('media/js/jquery.cookie.min.js'); ?>
    <?php echo HTML::script('media/js/calendar.min.js'); ?>
</body></html>
