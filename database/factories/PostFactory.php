<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $created_at = $this->faker->dateTimeBetween('-3 years', 'now');
        $updated_at = $created_at;
        if(rand(0, 3))
        {
            $updated_at = $this->faker->dateTimeBetween($created_at, 'now');
        }

        return [
            //
            //'title' => $this->faker->words(rand(1, 9), true),
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraphs(rand(1, 4), true),
            'updated_at' => $updated_at,
            'created_at' => $created_at,
        ];
    }
}
