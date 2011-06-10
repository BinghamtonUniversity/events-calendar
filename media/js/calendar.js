$(document).ready(function() {
    // Toggle events on and off by calendar
    $('.calendar_toggle').change(function(event) {
        var self     = $(this),
            calendar = self.data('calendar'), // get this calendar associated with the clicked element
            show     = self.is(':checked'); // assuming the element is a checkbox

        // Update the cookie to reflect the status of the checkbox
        $.cookie(calendar, show, { path: '/' });

        // Toggle all events for the changed calendar
        $('div.event').each(function() {
            if ($(this).data('calendar') === calendar) {
                if (show) {
                    $(this).parent('div.date').show();
                    $(this).show();
                } else {
                    $(this).hide();
                }
            }
        });

        // Hide the date container if there are no visible events on that date
        $('div.date').each(function() {
            if ($(this).find('div.event:visible').length === 0) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    });

    // Show all calendars
    $('#calendars_show_all').click(function(event) {
        $('.calendar_toggle').each(function() {
            if (!($(this).is(':checked'))) {
                $(this).prop('checked', true).change();
            }
        });
        event.preventDefault();
    });

    // Hide all calendars
    $('#calendars_hide_all').click(function(event) {
        $('.calendar_toggle').each(function() {
            if ($(this).is(':checked')) {
                $(this).prop('checked', false).change();
            }
        });
        event.preventDefault();
    });

    // Make the entire div clickable for calendar events
    $('.event').live({
        mouseenter: function() {
            $(this).css('background-color', '#E5EEEB');
            $(this).css('cursor', 'pointer');
        },
        mouseleave: function() {
            $(this).css('background-color', '#F5F6F6');
            $(this).css('cursor', 'default');
        },
        click: function() {
            window.location = $(this).find('a.event_link').attr('href');
        }
    });

    // Toggle color for show/hide all calendar buttons
    $('.calendars_show_buttons, #search_submit, .ui-datepicker-current').live({
        mouseenter: function() {
            $(this).css('background-color', '#E5EEEB');
            $(this).css('cursor', 'pointer');
        },
        mouseleave: function() {
            $(this).css('background-color', '#F5F6F6');
            $(this).css('cursor', 'default');
        }
    });

    // jQuery UI datepicker
    $(function() {
        $('#datepicker').datepicker({
            showButtonPanel: true,
            minDate: '0',
            onSelect: function() {
                $date = $('#datepicker').datepicker('getDate');
                $formatted_date = $.datepicker.formatDate('yy-mm-dd', $date);
                $.get('/events/index.php/calendar/show/' + $formatted_date, function(data) {
                    $('#list_view').html(data);
                });
            }
        });
    });

    // Make the 'today' button actually select today
    $('button.ui-datepicker-current').live('click', function() {
        $('.ui-datepicker-today').click();
    });
});
