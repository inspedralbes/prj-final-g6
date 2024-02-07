<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bereal extends Model
{
    use HasFactory;

    protected $table = 'photos'; 

    protected $fillable = [
        'latitude',
        'longitude',
        'image_path',
    ];
}
