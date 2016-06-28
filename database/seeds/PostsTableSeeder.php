<?php

use Illuminate\Database\Seeder;
use Korona\Post;
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();

        $min = DB::table('users')->min('id');
        $max = DB::table('users')->max('id');

        $faker = Faker::create();
        foreach (range(1, 50) as $index) {
            DB::table('posts')->insert([
                'user_id' => $faker->numberBetween($min, $max),
                'body' => $faker->text(1000),
                'postable_id' => $faker->numberBetween($min, $max),
                'postable_type' => 'Korona\User',
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'touched_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
