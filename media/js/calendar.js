$(document).ready(function() {
    //$('#search_string').focus();
    $('#search_string').click(function() {
        $(this).select();
    });

    // Toggle events on and off by calendar
    $('.calendar_toggle').change(function(event) {
        var self = $(this),
            calendar = self.data('calendar'), // get this calendar associated with the clicked element
            show = self.is(':checked'); // assuming the element is a checkbox

        // Toggle all events for the changed calendar
        $('p.event').each(function() {
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
            if ($(this).children('p.event:visible').length === 0) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    });

    // Show all calendars
    $('.show_all').click(function(event) {
        $('.calendar_toggle').each(function() {
            if (!($(this).attr('checked'))) {
                $(this).attr('checked', true).change();
            }
        });
        event.preventDefault();
    });

    // Hide all calendars
    $('.hide_all').click(function(event) {
        $('.calendar_toggle').each(function() {
            if ($(this).attr('checked')) {
                $(this).removeAttr('checked').change();
            }
        });
        event.preventDefault();
    });

    $('a.event_link').click(function(event) {
        $.get('calendar.php', { event: $(this).data('event') }, function(data) {
            $('div#calendar_view').html(data);
        });
        event.preventDefault();
    });

    //$('#search_form').submit(function(event) {
        //$.get('calendar.php', { search_string: $('#search_string').val() }, function(data) {
            //$('div#calendar_view').html(data);
        //});
        //event.preventDefault();
    //});
    $('#search_string').keyup(function(event) {
        $.get('calendar.php', { search_string: $('#search_string').val() }, function(data) {
            $('div#calendar_view').html(data);
        });
    });

    $('.event').mouseenter(function(event) {
        $(this).css('background-color', '#E5EEEB');
    });

    $('.event').mouseleave(function(event) {
        $(this).css('background-color', '#F5F6F6');
    });

    $('.event').click(function(event) {
        //window.location = $(this).
        window.location = $(this).find('a.event_link').attr('href');
    });
});
