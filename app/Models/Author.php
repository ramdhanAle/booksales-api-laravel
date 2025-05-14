<?php

namespace App\Models;

class Author
{
    public static function all()
    {
        return [
            ['id' => 1, 'name' => 'John Doe'],
            ['id' => 2, 'name' => 'Rahmat'],
            ['id' => 3, 'name' => 'Megumi'],
            ['id' => 4, 'name' => 'Yuki'],
            ['id' => 5, 'name' => 'Yudi']  
      ];
    }
}