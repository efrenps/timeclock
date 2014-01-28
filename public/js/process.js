$('#searchEmployeList').val('');

$(document).ready(function () {
    $("body").queryLoader2({
        percentage: true,
        completeAnimation: 'fade',
        barColor: "#9F2222",
        barHeight: 0,
        deepSearch: true,
        onComplete: function () {
            $("#mainContent").show();
            $("#slide2").hide();
            $("#slide3").hide();
            $("#password").blur(function () {
                window.setInterval(function () {
                    $("#password").focus();
                    window.clearInterval(1)
                }, 200);
            });

            retrieveListEmployee('');
        }
    });
});

$('#searchEmployeList').keypress(function (e) {
    if (e.keyCode == 13) {
        retrieveListEmployee($('#searchEmployeList').val());
    }
});


function retrieveListEmployee(search) {
    $.ajax({
        type: "GET",
        url: "employeeActions",
        data: {
            name: search
        },
        success: function (msg) {
            console.log(msg);
            $('#listEmployeeTable').html
            (
                msg
            );
        },
        failure: function (msg) {
            alert('Employee not found');
        }
    });
}


function animEffect(id, effect) {
    $(id).removeClass().addClass(effect + ' animated').one('webkitAnimationEnd oAnimationEnd', function () {
        $(this).removeClass();
    });
}

var employeeId = 0;
var currentTimeId = 0;

$("html,body").animate({ scrollTop: 0 }, "slow");

$('.fancySelect').fancySelect();

toastr.options = {
    "closeButton": false,
    "debug": false,
    "positionClass": "toast-top-left",
    "onclick": null,
    "showDuration": "5000",
    "hideDuration": "2000",
    "timeOut": "2000",
    "extendedTimeOut": "2000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

$('#name').val('').fancyInput()[0].focus();
function init(str) {
    var input = $('section input').val('')[0],
    s = 'type your name... ✌'.split('').reverse(),
    len = s.length - 1,
    e = $.Event('keypress');
    var initInterval = setInterval(function () {
        if (s.length) {
            var c = s.pop();
            fancyInput.writer(c, input, len - s.length).setCaret(input);
            input.value += c;
        }
        else clearInterval(initInterval);
    }, 10);
}

//init();

$(function () {

    $("#name").autocomplete(
    {
        source: 'getdata',
        zIndex: 9999,
        response: function (event, ui) {
            // ui.content is the array that's about to be sent to the response callback.
            if (ui.content.length === 0) {

                toastr.error("Sorry, employee not found!", "ERROR");
                fancyInput.clear($('#name').val('')[0].nextElementSibling);
            }
        },
        select: function (event, ui) {
            $("#slide2").show();

            employeeId = ui.item.id;

            fancyInput.clear($('#name').val('')[0].nextElementSibling);

            var input = $('#name').val('')[0],
            s = ui.item.description.split('').reverse(),
            len = s.length - 1,
            e = $.Event('keypress');
            var initInterval = setInterval(function () {
                if (s.length) {
                    var c = s.pop();
                    fancyInput.writer(c, input, len - s.length).setCaret(input);
                    input.value += c;
                }
                else clearInterval(initInterval);
            }, 10);

            htmlbody.animate({
                scrollTop: $('.slide[data-slide="2"]').offset().top
            }, 1500, 'easeInOutQuint');

            setTimeout(function () {
                $('#password').val('').fancyInput()[0].focus();
                animEffect('#content2', 'fadeInRightBig');
            }, 500);

            setTimeout(function () {
                $("#slide1").hide();
                $('#content2').show();
                $('#password').val('').fancyInput()[0].focus();
            }, 1500);
        }
    })
});

$(function () {
    $('#password').keypress(function (e) {
        if (e.keyCode == 13) {
            $.ajax({
                type: "GET",
                url: "authenticate",
                data: {
                    userid: employeeId,
                    password: document.getElementById('password').value
                },
                success: function (msg) {
                    $('#slide3').show();
                    
                    try {
                       var data = JSON.parse(msg);
                    } catch (err) {
                        toastr.error("Incorrect password!", "ERROR");
                        fancyInput.clear($('#password').val('')[0].nextElementSibling);
                        return;                      
                    }

                    if (data != null & data.length > 0 & data[0].error == '0') {

                        processBtn(data[0].Action);
                        toastr.info("Welcome " + data[0].FullName + "", "INFO");
                        $('#result').html
                        (
                            '<h2>Welcome ' + data[0].FullName + '</h2>'
                        );

                        currentTimeId = data[0].CurrentTimeId;
                    }
                    else {
                        toastr.error("Incorrect password!", "ERROR");
                        fancyInput.clear($('#password').val('')[0].nextElementSibling);
                        return;
                    }

                    htmlbody.animate({
                        scrollTop: $('.slide[data-slide="3"]').offset().top
                    }, 1500, 'easeInOutQuint');

                    document.getElementById('name').value = '';
                    document.getElementById('password').value = '';
                    document.getElementById('reason').value = '1';

                    setTimeout(function () { $("#slide1").hide(); $("#slide2").hide(); }, 1500);
                },
                failure: function (msg) {
                    alert('Employee not found');
                }
            });
        }
    });
});

function processBtn(result) {
    //si es cero mostrar el start, si es mostrar el stop
    var element;
    if (result == 0) {
        element = document.getElementById("divstart");
        element.className = "show";
        element = document.getElementById("divstop");
        element.className = "hide";
        setTimeout(function () { animEffect('#divstart', 'fadeInUpBig'); }, 800);
    }
    else if (result == 1) {
        element = document.getElementById("divstart");
        element.className = "hide";
        element = document.getElementById("divstop");
        element.className = "show";
        setTimeout(function () { animEffect('#divstop', 'fadeInUpBig'); }, 800);
    }
};

$(function (actionresult) {
    $("#startbtn").click(function () {
        $("#startbtn").disabled = true;
        processTimer("Start");
        //setTimeout(function () { animEffect('#divstart', 'bounceOutRight'); }, 800);        
    })
});

$(function (actionresult) {
    $("#stopbtn").click(function () {
        $("#stopbtn").disabled = true;
        if (document.getElementById('reason').value == 1) {
            toastr.warning("You must select a reason", "WARNING");
            return;
        }

        processTimer("Stop");
        //setTimeout(function () { animEffect('#divstop', 'bounceOutRight'); }, 800);        
    })
});

function processTimer(btn) {
    $.ajax({
        type: "GET",
        url: "savework",
        data: {
            userid: employeeId,
            action: btn,
            reason: btn == "Start" ? "Work" : document.getElementById('reason').value
            // currenttimeid: currentTimeId
        },
        success: function (msg) {

            if (msg.indexOf("[PE]") != -1) {
                toastr.error(msg.substring(4), "INFO");
                return;
            }

            var data = JSON.parse(msg);

            if (data != null) {
                toastr.success("You are " + data[0].Action + " for " + data[0].Reason + "", "SUCCESS");
            }

            setTimeout(function () { document.location.reload(); }, 3000);
        },
        failure: function (msg) {
            toastr.error("An error has ocurred while processing action", "ERROR");
            $("#stopbtn").disabled = false;
            $("#startbtn").disabled = false;
        }
    });
}