<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuarioModel extends Model
{
    use HasFactory;

    protected $fillable
        = ['nombre', 'password', 'email',];
    protected $hidden = ['created_at', 'updated_at',];
    protected $table = 'usuarios';
}
