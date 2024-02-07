<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\usuarioModel;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function register(Request $request)
    {
        $validator = usuarioModel::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
            'phone' => 'required|string|max:255',
            'birthdate' => 'required|date',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = usuarioModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,

        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return response(['user' => $user, 'token' => $token]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response(['message' => 'Invalid credentials'], 401);
        }

        $user = $request->user();
        $token = $user->createToken('authToken')->plainTextToken;

        return response(['user' => $user, 'token' => $token]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response(['message' => 'Logged out']);
    }

    
    public function userProfile()
    {
        return response()->json([
            "status" => 0,
            "msg" => "Perfil del usuario",
            "data" => auth()->user()
        ]);
    }
 
}
