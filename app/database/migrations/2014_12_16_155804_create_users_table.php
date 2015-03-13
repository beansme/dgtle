<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('openid');
			$table->string('user_id');
			$table->string('nickname');
			$table->string('language');
			$table->string('sex');
			$table->string('province');
			$table->string('city');
			$table->string('country');
			$table->string('headimgurl');
			$table->string('privilege');
			$table->string('remember_token');
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
		Schema::drop('users');
	}

}
