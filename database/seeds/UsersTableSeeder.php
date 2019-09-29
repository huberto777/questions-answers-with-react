<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pl_PL');

        for ($i=1; $i<=3 ; $i++) { 

        	DB::table('users')->insert([
		        'name' => $faker->name,
		        'email' => $faker->unique()->safeEmail,
		        'email_verified_at' => now(),
		        'password' => bcrypt('qwerty'), // secret
		        'remember_token' => str_random(10),
        	]);
        }
    }
}

