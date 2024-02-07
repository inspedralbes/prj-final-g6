<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\usuarioModel;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Database\Eloquent\Relations\MorphMany;

class userController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password2' => 'required|same:password',
            'phone' => 'required',
            'birthdate' => 'required',
        ]);

        $user = new usuarioModel();
        $user->nombre = $request->nombre;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->birthdate = $request->birthdate;
        $user->password = Hash::make($request->password);

        $user->save();

        return response()->json([
            "status" => 1,
            "msg" => "Registro exitoso",
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'

        ]);
        $user = usuarioModel::where("email", "=", $request->email)->first();

        if (isset($user->id)) {
            if (Hash::check($request->password, $user->password)) {
              
                $token = $user->createToken("auth_token")->plainTextToken;
                
                //si esta todo bien
                return response()->json([
                    "status" => 1,
                    "msg" => "Usuario logeado  exitosamente",
                    "access_token" => $token

                ]);
            } else {
                return response()->json([
                    "status" => 0,
                    "msg" => "La password es incorrecta",

                ], 404);
            }
        } else {
            return response()->json([
                "status" => 0,
                "msg" => "Usuario no registrado",
            ], 404);
        }
    }
    public function userProfile()
    {
        return response()->json([
            "status" => 0,
            "msg" => "Perfil del usuario",
            "data" => auth()->user()
        ]);
    }
    public function logout()
    {
        if (auth()->check()) {
            auth()->user()->tokens()->delete();
            return response()->json([
                "status" => 1,
                "msg" => "Logout exitoso",
            ]);
        }

        return response()->json([
            "status" => 0,
            "msg" => "Usuario no autenticado",
        ], 401);
    }
    public function updateUserProfile(Request $request)
    {
        $user = auth()->user();
    
        // Aquí debes agregar la lógica para actualizar el perfil del usuario
        //Puedes utilizar  $request->input('name') y $request->input('email');
       
        
        // Ejemplo de actualización del nombre del usuario
        $user->name = $request->input('name');
        $user->save();
    
        return response()->json([
            "status" => 1,
            "msg" => "Perfil del usuario actualizado exitosamente",
            "data" => $user,
        ]);
    }
    public function getUsers()
    {
        $users = usuarioModel::all();
        return response()->json([
            "status" => 1,
            "msg" => "Lista de usuarios",
            "data" => $users
        ]);
    }



}
