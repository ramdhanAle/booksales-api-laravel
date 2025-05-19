<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Author extends Model
{
    use HasFactory; 
    
    protected $fillable = ['name', 'email']; 
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}