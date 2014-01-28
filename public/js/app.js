/*
This file handles jquery calls 
source:'http://servidordesarrollo/TimeClock/public/dashboard/getdata',
*/

// Autocomplete-jquery function, send employee name and look for criteria
// JSON response is send it back to the front-end and the criteria match is higlights
var j = jQuery.noConflict();
j( document ).ready( function(){

$('form').submit(function(event) {
  event.preventDefault();
});

j("form").keypress(function(e) {
        if (e.which == 13) {
                if(j("#search").val().length < 1) {
                               alert("Please enter your name");
                               return false;
                    } else{
                        if(j("#password").val().length  > 0) {

                            $.post( "authenticate", j( "form" ).serialize(), function( data ) {
                                if (data =='1') {
                                    // Show third screen and show the start work button
                                    j('#buttonStart').show();
                                    return false;
                                } else if (data =='2') {
                                    // Show third screen and show the stop work button
                                    j('select').show();
                                    j('#buttonPause').show();
                                    return false;
                                } else {
                                    // Returns any error or exception message
                                    alert(data);
                                    return false;
                                }

                            });
                            return false;
                        } else {
                            alert("Please enter your password");
                            return false;
                        }
                }
       }
    });

// This function allows autocomplete when user start typing his name
j('#search').autocomplete({
     delay: 1000,
     minLength: 2,
     source:'getdata', // getdata is the laravel route defined on routes.php
     autoFocus: true,
     select: function(event, data){
        var valor  = j('#term').val();
        j('#employeeId').val(data.item.id); // Assign the employeeId to input of the hidden
        // Show second screen that shows password input
        j('#password').show();
        j('#password').focus();
     }
 }); 

// This function send the data to the savework route defined on route.php via post method
        // Display one message once the response has the response value equal '1'
        j('#startbtn').click(function() {
                var name = j('#search').val();
                $.post( "savework", j( "form" ).serialize(), function( data ) {
                   if (data == 1) {
                       alert('Welcome ' + name);
                       document.location.href = 'dashboard';
                   }
                });
         });

        // Validates select reason if the employee have no select any reason to stop work button
        // sends the data to the stopwork route defined on route.php via post method
        j('#stopbtn').click(function() {
           var valor = $('#reason').val();
           var name = j('#search').val();
           if (valor==1) {
               alert('Please select a reason')
          } else{
               $.post( "stopwork", j( "form" ).serialize(), function( data ) {
                   alert (data + name);
                   document.location.href = 'dashboard';
                });
             };
         });

});