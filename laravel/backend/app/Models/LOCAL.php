<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LOCAL extends Model
{
    use HasFactory;

    protected $table = 'LOCALES'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'coordenadas',
        'imgUrl',
        'minEdad',
        'horario',
        'nombre_local',
        'telefono',
        'descripcion',
    ];

    protected $casts = [
        'coordenadas' => 'json', // Campo coordenadas se convierte a tipo JSON
    ];
}
