<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reviewModel extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'user_id',
        'local_id',
        'puntuacion',
        'comentario',
        'destacado',
        'fecha',

    ];
}
