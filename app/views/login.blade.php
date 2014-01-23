@extends('master')

<div id="topbar" class="row"></div>

<section id="containerMain" class="row">
	<h1 id="label1" class="row">Discover</h1>
	<h2 id="label2" class="row">a new way to manage your hours worked</h2>

	<section id="formlogin" class="container">
		{{ Form::open(array('url' => 'validate', 'class'=>'form-horizontal', 'role'=>'form','style'=>'max-width:97%;padding-left:5%;padding-right:5%;')) }}
        <h2><i class="fa fa-user"></i> Username</h2>
        <div class="form-group"></div>
        {{ Form::text('login', null, array('class'=>'form-control', 'placeholder'=>'Insert  Your Username')) }}
        <div class="form-group"></div>        
        {{-- Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) --}}
        <div class="form-group"></div>        
		{{ Form::close() }}
	</section>
    


</section>







