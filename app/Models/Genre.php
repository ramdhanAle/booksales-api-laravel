<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    // HAPUS method all() yang di-override
    // Biarkan Laravel menggunakan method all() default dari Eloquent
    
    // Jika ingin data default, buat method terpisah
    public static function defaultGenres()
    {
        return [
            ['name' => 'Fantasi'],
            ['name' => 'Fiksi Ilmiah'],
            ['name' => 'Romansa'],
            ['name' => 'Misteri'],
            ['name' => 'Horor']
        ];
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}