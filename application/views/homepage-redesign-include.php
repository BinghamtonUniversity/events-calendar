<div class="cubes" id="cubeCalendar">
  <div class="greenHeader">
    <h4 class="spaced">
      <span class="h4Topics h4Featured">Featured</span> Events<a href="http://calendar.binghamton.edu/"><img src="http://www.binghamton.edu/gerald/redesign13/images/calendar-white.png" alt="calendar" /></a>
    </h4>
  </div>
  <ul>
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
      <li><strong><?php echo $day_of_week; ?>,</strong> <span class="calendarDates"><?php echo $formatted_date; ?></span><br /> <a href="<?php echo $link; ?>"><?php echo $event->title; ?></a></li>
    <?php
      }
    ?>
  </ul>
</div>
