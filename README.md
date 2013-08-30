# Binghamton University Events Calendar

This Events Calendar site was developed using the Kohana PHP framework (v3.1).

The calendar displays a filtered, searchable list of events that is aggregated from multiple Google Calendars.

[Zend_Gdata](http://framework.zend.com/manual/1.12/en/zend.gdata.html) was used to interface with the Google Calendar API, and [iCalcreator](http://kigkonsult.se/iCalcreator/) was used to generate iCal feeds for use in the University's mobile applications.

## Configuration

Two files in the `app/config` directory contain the database and Google account information. The Events Calendar application will download and aggregate all of the Google Calendars owned by the account specified in `app/config/google.php`.
