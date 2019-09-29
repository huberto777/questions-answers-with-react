<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pl_PL');

        for ($i=1; $i<=10 ; $i++) { 

        	DB::table('questions')->insert([

	        	'title' => $faker->text(50),
	        	'slug' => str_slug($faker->unique()->text(50),'-'),
		        'body' => $faker->text(500), 
		        'views' => $faker->numberBetween(0,10), 
		        'answers_count' => $faker->numberBetween(0,10), 
		        'votes_count' => $faker->numberBetween(0,10),
		        'user_id' => $faker->numberBetween(1,3) ,
                'created_at' => new \DateTime() // jedna z kolumn timestamps
        	]);
        }
    }
}
