<?php

use Illuminate\Database\Seeder;
use App\{User,Question,Answer};

class VotablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('votables')->delete();

        $users = User::all();
        $numberOfUsers = $users->count();

        foreach(Question::all() as $question)
        {
        	for ($i = 0; $i < rand(0, $numberOfUsers) ; $i++)
        	{
                $user = $users[$i];
                $question->users()->attach($user);
        	}
        }

        foreach(Answer::all() as $answer)
        {
        	for ($i = 0; $i < rand(0, $numberOfUsers) ; $i++)
        	{
        		$user = $users[$i];
        		$answer->users()->attach($user);
        	}
        }

    }

}
