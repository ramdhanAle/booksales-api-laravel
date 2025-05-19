<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'author_id' => Author::factory(),
            'genre_id' => Genre::factory(),
            'isbn' => $this->faker->unique()->isbn13(), 
            'published_year' => $this->faker->year(),
            // atau gunakan format lain:
            // 'isbn' => $this->faker->numerify('#############'),
        ];
    }
}