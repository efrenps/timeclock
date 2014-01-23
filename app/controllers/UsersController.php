<?php

class UsersController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function get_dashboard()
	{
		return View::make('dashboard');
	}
	

}