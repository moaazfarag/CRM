<?php

class DatabaseSeeder extends Seeder {


	public function run()
	{
		Eloquent::unguard();

		$this->call('companyDataSeeder');
		$this->call('branchesSeeder');
		$this->call('seasonsSeeder');
		$this->call('marksSeeder');
		$this->call('modelsSeeder');
		$this->call('itemsSeeder');
		$this->call('accountsSeeder');
		$this->call('catSeeder');
		$this->call('usersSeeder');
	}

}
