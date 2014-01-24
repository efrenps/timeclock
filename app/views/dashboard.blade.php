@extends('master')
<div id="dashboardtopbar" class="row"></div>

<section id="dashboardMain" class="row">
	
	<section id="clock" style="background-color: #bdc3c7;" class="row">
		<div class="clock" style="margin:2em;padding-left:5%;"></div>
	</section> 

	<section id="buttons" class="container" style="max-width:50%">
		<div class="container">			
		</div>
		{{ Form::open(array('url' => 'authenticate2', 'class'=>'container', 'role'=>'form'))}}
        <h2><i class="fa fa-user"></i> Name</h2>
        <div class="form-group"></div>
        <div class="ui-widget" id="username">        	
  	       {{ form::text('search', '', array('id' => 'search', 'class'=>'form-control', 'style'=>'max-width:50%;font-size:17px;', 'placeholder'=>'Enter your name here') )}}
  	     </div>         
       <div class="form-group"></div>
       <input   name="password" type="password" id="password" class="form-control" placeholder="Enter your password here" style="display:none;font-size:17px;"></input>
       <div class="form-group"></div>
        <select id="reason" name="reason" class="selectpicker" style="width:25%;display:none;"> 
			<option value="1">select a reason</option>
			<option value="Lunch">Lunch</option>
			<option value="Leave Work">Leaving for the day</option>
			<option value="Other">Other</option> 
	   </select>
	   <div class="form-group"></div>
       <button id="buttonStart" class="btn btn-info btn-lg" type="submit" style="display:none;margin-top:2%;">Start Work</button>
       <button id="buttonPause" class="btn btn-danger btn-lg" type="submit" style="display:none;margin-top:2%;">Stop Work</button>   
		{{ Form::close() }}		
	</section>
	<div id="oculto" hidden></div>
	<h1 id="message" style="padding-left:3%;"></h1>
	
</section>







