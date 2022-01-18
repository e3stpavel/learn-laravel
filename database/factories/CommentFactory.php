<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //post
        $created_at = $this->faker->dateTimeBetween('-3 years', 'now');
        $updated_at = $created_at;
        if(rand(0, 3))
        {
            $updated_at = $this->faker->dateTimeBetween($created_at, 'now');
        }

        return [
            'body' => $this->faker->paragraph,
            'updated_at' => $updated_at,
            'created_at' => $created_at,
        ];
    }
}
