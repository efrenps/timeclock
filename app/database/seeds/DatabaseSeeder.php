<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		 $this->call('EmployeesTableSeeder');
	}
}

class EmployeesTableSeeder extends Seeder{
		 public function run(){

		 	 DB::table('employees')->insert(array(
                'firstname' => 'Jose',
                'lastname' => 'Juarez',
                'username' => 'jose123',
                'password' => sha1('123'),
                'pay' => '300',
                'created_at' => date('Y-m-d'),
		'updated_at' => date('Y-m-d')
	        ));

		 	 DB::table('employees')->insert(array(
                'firstname' => 'Julio',
                'lastname' => 'Juarez',
                 'username' => 'julio123',
                'password' => sha1('123'),
                'pay' => '300',
		'created_at' => date('Y-m-d'),
		'updated_at' => date('Y-m-d')
	        ));

		 	 DB::table('employees')->insert(array(
                'firstname' => 'Jimmy',
                'lastname' => 'Juarez',
                'username' => 'jimmy123',
                'password' => sha1('123'),
                'pay' => '300',
		'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d') 
	        ));
	 
	        
		 }
}
