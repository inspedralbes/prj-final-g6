<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class USUARIO extends Model
{
    use HasFactory;

    protected $table = 'USUARIOS'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'nombre',
        'email',
        'passwrd',
        'telefono',
        'fecha_nacimiento',
    ];

    // Puedes agregar otros atributos protegidos o métodos según tus necesidades.

    // Eloquent asume que el nombre de la clave primaria es 'id', pero puedes cambiarlo si es necesario
    protected $primaryKey = 'id';
}
