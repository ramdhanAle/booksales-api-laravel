<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre {
    public static function all()
    {
        return [
            ['id' => 1, 'name' => 'Fantasi'],
            ['id' => 2, 'name' => 'Fiksi Ilmiah'],
            ['id' => 3, 'name' => 'Romansa'],
            ['id' => 4, 'name' => 'Misteri'],
            ['id' => 5, 'name' => 'Horor']
        ];
    }
}