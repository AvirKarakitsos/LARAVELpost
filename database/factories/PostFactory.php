<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(rand(1,3),true),
            'content' => $this->faker->sentences(rand(2,4),true),
            'image' => 'https://via.placeholder.com/150',
            'url' => $this->faker->sentence(1,true),
            'category_id'=>rand(1,8)
        ];
    }
}
