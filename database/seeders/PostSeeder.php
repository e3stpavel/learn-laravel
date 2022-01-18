<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //list of users
        $users = User::all();

        foreach ($users as $user)
        {
            //every user have 100 posts and have db constraint already
            $posts = Post::factory(rand(0, 50))->create(['user_id' => $user->id]);
            $posts->each(function (Post $post) {
                $tags = Tag::inRandomOrder()->take(rand(0, 5))->get();
                foreach ($tags as $tag) {
                    $post->tags()->attach($tag);
                }

                $post->save();
            });
        }

        //Post::factory(1000)->create();

        #TODO User page with posts, posts counter, comment counter
    }
}
