<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AdminTableSeeder extends Seeder {

	public function run()
	{
		DB::table('admin')->truncate();
		DB::table('admin')->insert([
				['username' => 'admin', 'password' => Hash::make('admin2014')]
			]);
	}

}