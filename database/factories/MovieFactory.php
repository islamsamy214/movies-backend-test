<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(20),
            'description' => $this->faker->text(),
            'image' => 'movietest',
            'rate' => random_int(1, 5),
            'user_id' => random_int(1, 5),
        ];//end of movies factory
    }
}
