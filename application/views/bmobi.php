<h2>iCal Data Feeds for bMobi</h2>
<ol>
  <?php
    foreach ($calendars as $calendar) {
      echo "<li>";
      echo "<a href='/index.php/feed/ics/$calendar->id'>$calendar->title</a>";
      echo "</li>";
    }
  ?>
</ol>
