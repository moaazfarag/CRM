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
            $table->integer('employee_id');
            $table->integer('co_id');
            $table->char('name','75');
            $table->integer('branch_id');
            $table->dateTime('employee_date');
            $table->enum('work_nature',array('دائم','مؤقت'));
            $table->integer('department_id');
            $table->integer('job_id');
            $table->decimal('salary',18,2);
            $table->decimal('ins_salary',18,2);
            $table->decimal('ins_val',18,2);
            $table->char('ins_no','50');
            $table->char('card_no','14');
            $table->dateTime('cancel_date');
            $table->char('cancel_cause','200');
            $table->enum('sex',array('انثى ','ذكر '));
            $table->enum('marital',array('اعزب ',' متزوج'));
            $table->enum('religion',array('مسلم ',' مسيحى'));
            $table->enum('military_service',array('تم الخدمه ',' معافى ','تاجيل'));
            $table->char('tel','200');
            $table->char('address','200');
            $table->dateTime('birth_date');
            $table->char('certificate','50');
            $table->dateTime('cert_date');
            $table->char('cert_location','50');
            $table->char('remark');
            $table->integer('user_id');
            $table->string('pic');
            $table->integer('finger_id');
            $table->integer('d_hours');
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
