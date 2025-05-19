<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GenreFactory extends Factory
{
    protected static $currentIndex = 0;
    protected static $genres = [
        'Fantasi',
        'Fiksi Ilmiah',
        'Romansa',
        'Misteri',
        'Horor',
        'Komedi',
        'Drama',
        'Sejarah'
    ];

    public function definition()
    {
        // Gunakan pendekatan sequential daripada random unique
        $name = self::$genres[self::$currentIndex % count(self::$genres)];
        self::$currentIndex++;

        return [
            'name' => $name,
        ];
    }
}