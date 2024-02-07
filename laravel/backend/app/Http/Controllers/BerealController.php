<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bereal;

class BerealController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'image' => 'required|image',
        ]);

        $Bereal = new Bereal;
        $Bereal->latitude = $request->latitude;
        $Bereal->longitude = $request->longitude;
        $Bereal->image_path = $request->file('image')->store('fotos');
        $Bereal->save();

        return response()->json(['message' => 'Foto almacenada con éxito']);
    }
}
