<!-- Start of Calendar -->
<table class="row" width="600" bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; text-align:left; border-spacing:0; max-width:100%;">
  <tr>
    <td colspan="2" style="padding-right:10px; padding-bottom: 10px; padding-left:10px; border-top:1px #dddddd dotted;">
      <table cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-spacing:0;">
        <tr>
          <td bgcolor="#f4f4f4" style="padding-top:5px; padding-right:5px; padding-bottom:5px; padding-left:5px; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:100%; color:#999999;">
            UNIVERSITY CALENDAR
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-spacing:0;">
        <tr>
          <td colspan="2" style="padding-top:5px; padding-right:10px; padding-bottom:0px; padding-left:10px; font-family:'Segoe UI', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:14px; line-height:18px; color:#666666; font-weight:300;">
            <ul id="events-calendar-list" style="left-index: 0px; font-family: Arial; font-weight: normal; list-style-type: none; padding-left: 0px;" >
              <?php
                  foreach ($feed_events as $event) {
                      $formatted_date = strftime('%b %e', strtotime($event->date));
                      echo "<li class=\"events-calendar-event\" style=\"color: #999999; font-size: 12px; font-family: Arial; font-weight: normal;\" ><strong>$formatted_date:</strong> <a style=\"color: #00694d; font-size: 12px; font-family: Arial; font-weight: normal;\" href=\"http://calendar.binghamton.edu/index.php/calendar/event/$event->permalink\">$event->title</a></li>";
                  }
              ?>
            </ul>
            <p id="events-calendar-link"><a style="color: #00694d; font-size: 12px; margin-left: 0px; font-family: Arial; font-weight: normal;" href="http://calendar.binghamton.edu/">More University Events →</a></p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<!-- End of Calendar -->
