<?php

class DatabaseSeeder extends Seeder {


	public function run()
	{
		Eloquent::unguard();
		$this->call('directMovementSeeder');
		$this->call('companyDataSeeder');
		$this->call('branchesSeeder');
		$this->call('seasonsSeeder');
		$this->call('marksSeeder');
		$this->call('modelsSeeder');
		$this->call('itemsSeeder');
		$this->call('accountsSeeder');
		$this->call('catSeeder');
		$this->call('usersSeeder');
        $this->call('hrDesDedSeeder');
        $this->call('hrEmpDesDedSeeder');
        $this->call('hrEmployeesSeeder');
        $this->call('hrJobsSeeder');
        $this->call('hrDepartmentsSeeder');
        $this->call('hrLoansSeeder');
        $this->call('hrMonthChangesSeeder');
        $this->call('hrMSDetailsSeeder');
        $this->call('hrMSHeaderSeeder');
        $this->call('settleSeeder');


    }

}
