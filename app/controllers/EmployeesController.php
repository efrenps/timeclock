<?php

class EmployeesController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function get_dashboard()
	{
		return View::make('dashboard');
	}

	//FUNCTION TEST   ANGULAR





	// END TEST ANGULAR 

	public function get_listEmployees(){
		// stores the term GET value
        $term = Input::get('search');
        $term = $term.'%';
        $data = array();
        
        // Stores the resultset data from the employees tables into the $search variable
        $search =  DB::table('employees')
			    ->where('username', 'like', $term)
			    ->get();

		 /* Iterate through the query result and stores the
        *  first_name concatenates with last_name columns and
        *  store the value into the data array
        */
        foreach ($search as $result => $employeeInfo) {
        	$data[] = $employeeInfo->username;
        } 
         // Return an array in json format 
        return json_encode($data);
	}

	public function post_authenticate(){

		# store datas
		$username = Input::get('search');
		$password = Input::get('password');
		$password = sha1($password);

		#search database
		$employee = DB::table('employees')
			    ->where('username', '=', $username)
			    ->where('password', '=', $password)
			    ->first();

		if (empty($employee)) {
			return 'Username or Pasword Incorrect';
		}else{
				#validate session work
				$validateSession = DB::table('employeesattendance')
								->where('employeeId', '=', $employee->id)
								->where('hoursWorked', '=', '0.00')
								->first();
 
				if (empty($validateSession)) {
					return '1
					';//START WORK
				}else{
					return '2';//STOP WORK
				}//END ELSE

		}//END ELSE
	}

	public function post_SaveStartWork()
	{
		# store datas
		$username = Input::get('search');
		$password = Input::get('password');
		$password = sha1($password);

		#search database
		$employee = DB::table('employees')
			    ->where('username', '=', $username)
			    ->where('password', '=', $password)
			    ->first();

		if (empty($employee)) {
			return 'Username or Pasword Incorrect';
		}else{
			
			#validate session work
			$validateSession = DB::table('employeesattendance')
							->where('employeeId', '=', $employee->id)
							->where('hoursWorked', '=', '0.00')
							->first();

			if (empty($validateSession)) {
				#data employee attendance
				$employeeId = $employee->id;
				$timeIn= date_create()->format('Y-m-d H:i:s');
				#Insert Database
				$attendanceId = DB::table('employeesattendance')
								->insert(array('employeeId' => $employeeId, 'timeIn' => $timeIn));
								return 'Welcome '.$employee->firstname;	
			}else{
				return 'Error! please close your session work';
			}			
		}
	}


	/* SAVE STOP WORK*/
	    // This function stores the time stops
	public function post_SaveStopWork()
	{
		$username = Input::get('search');
		$password = Input::get('password');
		$password = sha1($password);

		#search database
		$employee = DB::table('employees')
		->where('username', '=', $username)
		->where('password', '=', $password)
		->first();


		if (empty($employee)) {
			return 'Wrong Pasword, try again please';
		} else {
			#validate session work
			$validateSession = DB::table('employeesattendance')
			->where('employeeId', '=', $employee->id)
			->where('hoursWorked', '=', '0.00')
			->first();


			$timeIn = date_create()->format('Y-m-d H:i:s'); 
			
			if (empty($validateSession)) {			    
				return "You have to register start to work before doing a stop action"; 
			} else {
				
				$initial_date = $validateSession->timeIn;
				$end_date = $timeIn;

				// Split the initial date into pieces
				list($initial_day, $initial_hour) = explode(" ", $initial_date);
				list($year, $month, $day) = explode("-", $initial_day);
				list($hour, $minute, $second) = explode(":", $initial_hour);
				$initial_time = mktime($hour + 0, $minute + 0, $second + 0, $month + 0, $day + 0, $year);

				// Split the end date into pieces
				list($end_day, $end_hour) = explode(" ", $end_date);
				list($year, $month, $day) = explode("-", $end_day);
				list($hour, $minute, $second) = explode(":", $end_hour);
				$end_time = mktime($hour + 0, $minute + 0, $second + 0, $month + 0, $day + 0, $year);

				// Make the difference betweeen the SECONDS in the dates
				$seconds_difference = $end_time - $initial_time;

                // Calculate total hours worked 
                // Divide ($seconds_difference / 60) / 60
				$total_hours_worked = ( $seconds_difference / 60 ) / 60;
				$reason = Input::get('reason');

				DB::table('employeesattendance')
				->where('id', $validateSession->id)
				->update( array( 'timeOut' => $timeIn,
					'hoursWorked' => $total_hours_worked,
					'reasonLeave' => $reason));

				return "Time stop registered. Goodbye " . $employee->firstname . ' ' . $employee->lastname;
			}
		}
	}
	/* SAVE STOP WORKK*/	


}
