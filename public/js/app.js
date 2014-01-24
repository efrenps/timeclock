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
							    		//open  session'
							    		j('#buttonStart').show();

							    		return false; 
							    	} else if (data =='2') {
							    		//close session');
						        		 j('select').show();
						        		 j('#buttonPause').show();	 		  	
							    		return false; 
							    	}else{
							    			alert(data);
							    			return false;							    	
							    	}
							    	
						 		});
						        return false; 				          
						    } else{
						    	   alert("Please enter your password");
						    	   return false;
						    }
			    	}	        	
	        }
	    });
	//fixit

	/*j('#search').autocomplete({
	 	 delay: 0,
	     source:'getdata',
	     autoFocus: true,
	      select: function(data, event, ui){
	        var valor  = j('#term').val();       
	         //j('#buttonStart').show();
	 		 //j('#buttonPause').show();
	 		  	//j('select').show();
	 		 j('#password').show();
	     }¨
	 });*/
	//fixit

	j('#buttonStart').click(function() {
		$.post( "authenticate", j( "form" ).serialize(), function( data ) {
			if (data=='1') {
				alert('logueado')
			} else{alert(data)};
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
			    	j('#buttonPause').hide();
			   		});
			};
			
			/*
			*/
			
	 });

});