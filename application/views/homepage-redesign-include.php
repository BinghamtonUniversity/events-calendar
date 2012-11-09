<div class="cubes" style="margin-left: 0; margin-bottom: 15px">
  <div class="greenHeader">
    <h4 class="spaced">
      <span class="h4Topics" style="color: #ccc">Featured</span> Events<a href="http://calendar.binghamton.edu/"><img src="http://www.binghamton.edu/gerald/redesign13/images/calendar-white.png" alt="calendar" style="display: inline; padding: 5px 5px 0 0; float: right" /></a>
    </h4>
  </div>
  <ul style="margin: 0; padding: 5px 0 0 10px">
    <?php
      foreach ($feed_events as $event) {
        $formatted_date = strftime('%B %e', strtotime($event->date));
        $link = "http://calendar.binghamton.edu/index.php/calendar/event/$event->permalink";
        if (date('Ymd') == date('Ymd', strtotime($event->date))) {
          $day_of_week = 'Today';
        } else {
          $day_of_week = strftime('%A', strtotime($event->date));
        }
    ?>
      <li style="list-style-type: none; text-transform: uppercase; font-size: 13px; margin: 0 0 5px 0"><strong><?php echo $day_of_week; ?>, <span style="font-weight: 100;"><?php echo $formatted_date; ?></span></strong><br /> <a href="<?php echo $link; ?>" style="text-transform: none; font-size: 18px"><?php echo $event->title; ?></a></li>
    <?php
      }
    ?>
  </ul>
</div>
