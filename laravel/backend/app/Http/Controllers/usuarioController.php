<?php

namespace App\Http\Controllers;

use App\Models\User; // Agrega esta línea para importar la clase User
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class usuarioController extends Controller
{
    // crea el usuarioController
    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json($user);
    }

    // función para logear usuarios
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'Invalid credentials'
            ], 401);
        }
        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    // función para obtener todos los usuarios
    public function getUsers()
    {
        $users = User::all();
        return response()->json($users);
    }
}
