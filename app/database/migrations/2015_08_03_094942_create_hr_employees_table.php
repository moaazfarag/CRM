<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmployeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hr_employees', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('empCode');
            $table->integer('co_id');
            $table->char('empName','75');
            $table->integer('branchCode');
            $table->dateTime('empDate');
            $table->enum('workNature',array('دائم','مؤقت'));
            $table->integer('depCode');
            $table->integer('jobCode');
            $table->decimal('salary',18,2);
            $table->decimal('insSalary',18,2);
            $table->decimal('insVal',18,2);
            $table->char('insNo','50');
            $table->char('idCardNo','14');
            $table->dateTime('cancelDate');
            $table->char('cancelCause','200');
            $table->enum('sex',array('انثى ','ذكر '));
            $table->enum('marital',array('اعزب ',' متزوج'));
            $table->enum('religion',array('مسيحى ',' مسلم'));
            $table->enum('militaryService',array('تم الخدمه ',' معافى ','تاجيل'));
//            $table->char('marital','50');
//            $table->char('religion','50');
//            $table->char('militaryService','50');
            $table->char('tel','200');
            $table->char('address','200');
            $table->dateTime('birthDate');
            $table->char('certificate','50');
            $table->dateTime('certDate');
            $table->char('certLocation','50');
            $table->char('remark');
            $table->integer('userId');
            $table->string('pic');
            $table->integer('fingerId');
            $table->integer('dHours');
            $table->integer('comm1');
            $table->integer('comm2');

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
		Schema::drop('hr_employees');
	}

}
