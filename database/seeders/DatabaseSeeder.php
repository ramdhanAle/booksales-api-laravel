<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run()
    {
        // Buat 5 genre
        $genres = Genre::factory(5)->create();
        
        // Buat 10 author
        $authors = Author::factory(10)->create();
        
        // Buat 30 buku dengan relasi
        Book::factory(30)->create([
            'genre_id' => fn() => $genres->random()->id,
            'author_id' => fn() => $authors->random()->id,
        ]);
    }
}
