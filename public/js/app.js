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
	            return false;
	        }
	    });

	j('#search').autocomplete({
	 	 delay: 0,
	     source:'getdata',
	     autoFocus: true,
	      select: function(data, event, ui){
	        var valor  = j('#term').val();       
	         //j('#buttonStart').show();
	 		 //j('#buttonPause').show();
	 		 j('#password').show();
	     }
	 });

	j("#password").keypress(function(e){
	   	//e.preventDefault();
	   	j('select').show();
	   	j('#buttonStart').show();
	 	j('#buttonPause').show();   
	 });

	j('#buttonStart').click(function() {
	 	   $.post( "authenticate", j( "form" ).serialize(), function( data ) {
		    //j( "#message" ).html( data );
		    	alert (data);
		    	j('#password').val('');
		    	j('select').hide();
		    	j('#buttonStart').hide();
	 		    j('#buttonPause').hide();

		   });
			
	 });
	j('#buttonPause').click(function() {

			var valor = $('#reason').val();
			if (valor==1) {
				alert('Please select a reason')
			} else{

					 $.post( "authenticate2", j( "form" ).serialize(), function( data ) {
			    //j( "#message" ).html( data );
			    	alert (data);
			    	j('#password').val('');
			    	j('select').hide();
			    	j('#buttonStart').hide();
		 		    j('#buttonPause').hide();

			   		});
			};
			
			/*
			*/
			
	 });

});