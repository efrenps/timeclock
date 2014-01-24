<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', array('uses' => 'UsersController@get_dashboard'));

Route::get('dashboard', array('uses' => 'UsersController@get_dashboard'));

Route::get('getdata', array('uses' => 'EmployeesController@get_listEmployees'));

Route::post('authenticate', array('uses' => 'EmployeesController@post_authenticate'));

//Route::post('authenticate2', array('uses' => 'EmployeesController@post_SaveStopWork'));
