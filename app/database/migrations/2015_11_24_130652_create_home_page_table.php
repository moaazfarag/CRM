<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomePageTable extends Migration {

	/**
	 * Run the migrations.
	 *desc
	facebook url
	youtube url
	google
	twitter
	skype
	about
	email
	linkedin
	 * @return void
	 */
	public function up()
	{
		Schema::create('home_page', function(Blueprint $table)
		{

			$table->increments('id');
			$table->integer('co_id');
			$table->string('title');
			$table->longText('details');
			// about
			$table->mediumText('about');
			$table->longText('about_content');
			// sochial
			$table->string('facebook');
			$table->string('twitter');
			$table->string('google');
			$table->string('youtube');
			$table->string('linkedin');
			$table->string('instgram');


			$table->string('email');
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
		Schema::drop('home_page');
	}

}
