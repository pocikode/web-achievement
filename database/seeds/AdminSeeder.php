<?php

use Illuminate\Database\Seeder;
use \App\User;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     	// ADMIN
		// User::create([
		// 	'username'			=> 'admin',
		// 	'name'				=> 'Agus Supriyatna',
		// 	'email'				=> 'aguzsupriyatna7@gmail.com',
		// 	'password'			=> Hash::make('kokonaka'),
		// 	'remember_token'	=> str_random(10)
		// ]);

		// USER AGUS
		User::create([
			'username'			=> 'aguzs',
			'name'				=> 'Agus Supriyatna',
			'email'				=> 'aguzsupriyatna7@gmail.com',
			'password'			=> Hash::make('kokonaka'),
			'remember_token'	=> str_random(10)
		]);
    }
}
