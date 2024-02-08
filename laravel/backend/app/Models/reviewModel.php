<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reviewModel extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'user_id',
        'disco_id',
        'titulo',
        'puntuacion',
        'content',

    ];
    protected $table = 'reviews';
}
