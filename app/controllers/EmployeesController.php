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

	public function get_listEmployees(){
        // stores the term GET value
        $term = Input::get('term');
        $term = $term.'%';
        $data = array();

        // Stores the resultset data from the employees tables into the $search variable
        $search =  DB::table('employees')
                            ->where('firstname', 'like', $term)
                            ->orWhere('lastname', 'like', $term)
                            ->orWhere('username', 'like', $term)
                            ->get();

        /* Iterate through the query result and stores the
        *  first_name concatenates with last_name columns and
        *  store the value into the data array
        */
        foreach ($search as $result => $employeeInfo) {
             // $data[] = $employeeInfo->username;
                $data[] = array('id' => $employeeInfo->id,
                                'value' => $employeeInfo->firstname . ' '. $employeeInfo->lastname,
                                'description' => $employeeInfo->firstname . ' '. $employeeInfo->lastname);
        }
         // Return an array in json format
        return json_encode($data);
    }

    public function get_employeeActions(){
        // stores the term GET value
        $name = Input::get('name');
        //$name = $name.'%';
        $data = array();

        if ($name != null | $name != '') {
            $tsql = DB::table('employees')
                         ->leftJoin('employeesAttendance', 'employees.id', '=', 'employeesAttendance.employeeId')
                         ->where('employees.firstname', 'like', $name.'%')
                         ->orderBy('employeesAttendance.id', 'desc')
                         ->get();
        } else {
            $tsql = DB::table('employees')
                         ->leftJoin('employeesAttendance', 'employees.id', '=', 'employeesAttendance.employeeId')
                         ->orderBy('employeesAttendance.id', 'desc')
                         ->get();
        }

        $table = "<table>
                  <tr>
                    <td>Photo</td>
                    <td>First Name</td>
                    <td>Last name</td>
                    <td>Time</td>
                    <td>Action</td>
                    <td>Reason</td>
                  <tr/>";

                if ( !empty($tsql) ) {
                  foreach ($tsql as $result => $employeeInfo) {
                      $table .= "<tr>"; 
                      $table .= "<td>" . '<img src="images/employee.png" />'. "</td>"; 
                      $table .= "<td>" . $employeeInfo->firstname . "</td>"; 
                      $table .= "<td>" . $employeeInfo->lastname . "</td>";
                      // $table .= "<td>" . date_format($employeeInfo->timeIn, 'd/m/Y H:i:s'). "</td>"; 
                      if ($employeeInfo->hoursWorked == ""){
                          $table .= "<td>" . $employeeInfo->timeIn . "</td>";                       
                          $table .= "<td>" . "Start Work" . "</td>"; 
                      } else {
                          $table .= "<td>" . $employeeInfo->timeOut . "</td>";                      
                          $table .= "<td>" . "Stop Work" . "</td>";
                      }
                      $table .= "<td>" . $employeeInfo->reasonLeave . "</td>"; 
                      $table .= "</tr>"; 
                  }
                } 

               $table .= "</table>";  

        return $table;
    }

    public function post_authenticate(){
        $id = Input::get('userid');
        $password = Input::get('password');
        $password = sha1($password);
        $data = array();

        #search database
        $employee = DB::table('employees')
                    ->where('id', '=', $id)
                    ->where('password', '=', $password)
                    ->first();

        if (empty($employee)) {
                $error = 1;//empty employee
                $data[] = array('error' => $error); 

            return json_encode($data);
        }

        $employeeAttendance = DB::table('employeesAttendance')
                            ->where('employeeId', '=', $employee->id)
                            ->where('hoursWorked', '=', '0.00')
                            ->first();

        if (empty($employeeAttendance)) {
            // Employee start work
            $workStatus = 0;
        } else {
            // Employee stop work
            $workStatus = 1;
        }

        $error = 0;//empty employee
        $data[] = array('FirstName' => $employee->firstname, 
                     'FullName' => $employee->firstname . ' ' . $employee->lastname,
                     'Action' => $workStatus,
                     'error' => $error); 

        return json_encode($data);

    }

	public function post_SaveStartWork()
    {
        // data employee attendance
        $employeeId = Input::get('userid');
        $action = Input::get('action');
        $reasonLeave = Input::get('reason');
        $timeIn = date_create()->format('Y-m-d H:i:s');
        $data = array();

        if ($action == 'Start') {
            #Insert Database
            $attendanceId = DB::table('employeesAttendance')
                ->insert(array('employeeId' => $employeeId, 'timeIn' => $timeIn, 'reasonLeave' => $reasonLeave));
             
        } else {
            $employeeAttendance = DB::table('employeesAttendance')
                                 ->where('employeeId', '=', $employeeId)
                                 ->where('hoursWorked', '=', '0.00')
                                 ->first();

            $initial_date = $employeeAttendance->timeIn;
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

            // $reason = Input::get('reason');
            // $employeeId = Input::get('employeeId');
               $resultUpdateAttendance = DB::table('employeesAttendance')
                ->where('id', $employeeAttendance->id)
                ->update( array( 'timeOut' => $timeIn,
                                 'hoursWorked' => $total_hours_worked,
                                 'reasonLeave' => $reasonLeave));   
                   
        }

        $employeeData = DB::table('employees')
                        ->where('id','=', $employeeId)
                        ->first();

        $data[] = array("FullDescription"=>$employeeData->firstname.' ' .$employeeData->lastname,
                "Action" => $action,
                "Reason"=>$reasonLeave,
                "Time"=>$timeIn);

        return json_encode($data);
    }

} // End Employee Class