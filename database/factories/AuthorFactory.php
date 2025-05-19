<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;

class AuthorFactory extends Factory
{
    protected $model = Author::class;

   public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail, // Tambahkan email
        ];
    }

     public function configure()
    {
        return $this->afterMaking(function ($author) {
            // Reset unique generator untuk email
            $this->faker->unique(true);
        });
    }
}