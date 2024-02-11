<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LOCAL;

class LOCAL__CONTROLLER extends Controller
{
    //

    public function getDiscotecas()
    {
        $discotecas = LOCAL::all();

        return response()->json($discotecas);
    }

    // funcion para obtener una discoteca por id

    public function getDiscoteca($id)
    {
        $discoteca = LOCAL::find($id);
        return $discoteca;
    }

    // funcion para crear una discoteca
    // Estos son los campos de una discoteca: ['coordenadas', 'imgUrl', 'minEdad', 'horario', 'nombre_local', 'telefono',];

    public function createDiscoteca(Request $request)
    {
        $discoteca = LOCAL::create($request->all());
        return $discoteca;
    }

    // funcion para actualizar una discoteca

    public function updateDiscoteca(Request $request, $id)
    {
        $discoteca = LOCAL::find($id);
        $discoteca->update($request->all());
        return $discoteca;
    }

    // funcion para borrar una discoteca

    public function deleteDiscoteca($id)
    {
        $discoteca = LOCAL::find($id);
        $discoteca->delete();
        return $discoteca;
    }

    // funcion para obtener las discotecas por nombre

    public function getDiscotecasByName($nombre_local)
    {
        $discotecas = LOCAL::where('nombre_local', 'like', '%' . $nombre_local . '%')->get();
        return $discotecas;
    }

    // funcion para obtener las discotecas por edad

    public function getDiscotecasByAge($minEdad)
    {
        $discotecas = LOCAL::where('minEdad', '>=', $minEdad)->get();
        return $discotecas;
    }

    // funcion para obtener las discotecas por horario

    public function getDiscotecasBySchedule($horario)
    {
        $discotecas = LOCAL::where('horario', 'like', '%' . $horario . '%')->get();
        return $discotecas;
    }
}
