<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();

        $faker = Factory::create();

        foreach ($posts as $post)
        {
            Comment::factory(rand(0, 10))
                ->make([
                    'post_id' => $post->id,
                ])->each(function ($comment) use($post, $faker) {
                    $created_at = $faker->dateTimeBetween($post->created_at, 'now');
                    $updated_at = $faker->dateTimeBetween($created_at, 'now');

                    if (rand(0, 3)) {
                        $updated_at = $created_at;
                    }

                    $comment->created_at = $created_at;
                    $comment->updated_at = $updated_at;
                    $comment->user_id = User::inRandomOrder()->first()->id;

                    $comment->save();
                });
        }
    }
}
