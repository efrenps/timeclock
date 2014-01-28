
jQuery(document).ready(function ($) {
    
    //initialise Stellar.js
    //$(window).stellar();

    //Cache some variables
    slide = $('.slide');
    button = $('.button');
    //mywindow = $(window);
    htmlbody = $('html,body');


    //Setup waypoints plugin
    slide.waypoint(function (event, direction) {

        //cache the variable of the data-slide attribute associated with each slide
        dataslide = $(this).attr('data-slide');

        //if (dataslide != 1) {
        //    $('#header').removeClass('showObject');
        //    $('#header').addClass('hideObject');
        //    $("#headerContainer").addClass('hideObject');
        //}
        //else {
        //    $('#header').removeClass('hideObject');
        //    $('#header').addClass('showObject');
        //    $("#headerContainer").addClass('showObject');            
        //}

        //If the user scrolls up change the navigation link that has the same data-slide attribute as the slide to active and 
        //remove the active class from the previous navigation link 
        if (direction === 'down') {
            $('.navigation li[data-slide="' + dataslide + '"]').addClass('active').prev().removeClass('active');
        }
            // else If the user scrolls down change the navigation link that has the same data-slide attribute as the slide to active and 
            //remove the active class from the next navigation link 
        else {
            $('.navigation li[data-slide="' + dataslide + '"]').addClass('active').next().removeClass('active');
        }

    });

    //Create a function that will be passed a slide number and then will scroll to that slide using jquerys animate. The Jquery
    //easing plugin is also used, so we passed in the easing method of 'easeInOutQuint' which is available throught the plugin.
    function goToByScroll(dataslide) {
        htmlbody.animate({
            scrollTop: $('.slide[data-slide="' + dataslide + '"]').offset().top
        }, 2000, 'easeInOutQuint');
    }

    //When the user clicks on the button, get the get the data-slide attribute value of the button and pass that variable to the goToByScroll function
    button.click(function (e) {
        e.preventDefault();
        dataslide = $(this).attr('data-slide');

        goToByScroll(dataslide);

    });



    $(function () {

        // Cache some selectors

        var clock = $('#clock'),
            alarm = clock.find('.alarm'),
            ampm = clock.find('.ampm');

        // Map digits to their names (this will be an array)
        var digit_to_name = 'zero one two three four five six seven eight nine'.split(' ');

        // This object will hold the digit elements
        var digits = {};

        // Positions for the hours, minutes, and seconds
        var positions = [
            'h1', 'h2', ':', 'm1', 'm2', ':', 's1', 's2'
        ];

        // Generate the digits with the needed markup,
        // and add them to the clock

        var digit_holder = clock.find('.digits');

        $.each(positions, function () {

            if (this == ':') {
                digit_holder.append('<div class="dots">');
            }
            else {

                var pos = $('<div>');

                for (var i = 1; i < 8; i++) {
                    pos.append('<span class="d' + i + '">');
                }

                // Set the digits as key:value pairs in the digits object
                digits[this] = pos;

                // Add the digit elements to the page
                digit_holder.append(pos);
            }

        });

        // Add the weekday names

        var weekday_names = 'MON TUE WED THU FRI SAT SUN'.split(' '),
            weekday_holder = clock.find('.weekdays');

        $.each(weekday_names, function () {
            weekday_holder.append('<span>' + this + '</span>');
        });

        var weekdays = clock.find('.weekdays span');


        // Run a timer every second and update the clock

        (function update_time() {

            // Use moment.js to output the current time as a string
            // hh is for the hours in 12-hour format,
            // mm - minutes, ss-seconds (all with leading zeroes),
            // d is for day of week and A is for AM/PM

            var now = moment().format("hhmmssdA");

            digits.h1.attr('class', digit_to_name[now[0]]);
            digits.h2.attr('class', digit_to_name[now[1]]);
            digits.m1.attr('class', digit_to_name[now[2]]);
            digits.m2.attr('class', digit_to_name[now[3]]);
            digits.s1.attr('class', digit_to_name[now[4]]);
            digits.s2.attr('class', digit_to_name[now[5]]);

            // The library returns Sunday as the first day of the week.
            // Stupid, I know. Lets shift all the days one position down, 
            // and make Sunday last

            var dow = now[6];
            dow--;

            // Sunday!
            if (dow < 0) {
                // Make it last
                dow = 6;
            }

            // Mark the active day of the week
            weekdays.removeClass('active').eq(dow).addClass('active');

            // Set the am/pm text:
            ampm.text(now[7] + now[8]);

            // Schedule this function to be run again in 1 sec
            setTimeout(update_time, 1000);

        })();

        // Switch the theme

        $('a.button').click(function () {
            clock.toggleClass('light dark');
        });

    });
    
});
