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

Route::get('main', array('uses' => 'EmployeesController@get_home'));

Route::get('dashboard', array('uses' => 'UsersController@get_dashboard'));

Route::get('getdata', array('uses' => 'EmployeesController@get_listEmployees'));

Route::get('authenticate', array('uses' => 'EmployeesController@post_authenticate'));

Route::get('savework', array('uses' => 'EmployeesController@post_SaveStartWork'));

Route::post('stopwork', array('uses' => 'EmployeesController@post_SaveStopWork'));

Route::get('employeeActions', array('uses' => 'EmployeesController@get_employeeActions'));