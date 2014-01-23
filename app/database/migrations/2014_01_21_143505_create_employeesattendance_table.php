<?php

use Illuminate\Database\Migrations\Migration;

class CreateEmployeesattendanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('employeesAttendance', function($table)
		{
			$table->create();
			$table->increments('id');
			$table->integer('employeeId');
			$table->datetime('timeIn');
			$table->datetime('timeOut');
			$table->float('hoursWorked');
			$table->string('reasonLeave');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employeesAttendance');
	}

}