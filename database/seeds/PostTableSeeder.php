<?php

use App\User;
use Illuminate\Database\Seeder;
use App\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        for ($i=1;$i<=55;$i++){
        $users = User::all()->pluck('id')->toArray();


        $faker = Faker\Factory::create();
        $post = new Post;

        $post -> id = $i;
        $post -> post = $faker->text($maxNbChars = 200);

        $post -> user_id =$faker->randomElement($users);
        $post->save();
        }
    }
}
