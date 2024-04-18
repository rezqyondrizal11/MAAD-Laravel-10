<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // Tentukan kolom mana yang merupakan primary key
    public $incrementing = false; // Beritahu Laravel bahwa kolom 'id' tidak di-increment secara otomatis

    // Tentukan atribut yang dapat diisi (fillable)
    protected $fillable = ['id', 'name', 'show_on_menu'];

    public function rPost()
    {
        return $this->hasMany(Post::class);
    }
}
