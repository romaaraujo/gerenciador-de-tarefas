<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => Str::random(100),
            'file_url' => 'http://file-faker' . Str::random(5) . '.com.br/factory/' . Str::random(5) . '.pdf'
        ];
    }
}
