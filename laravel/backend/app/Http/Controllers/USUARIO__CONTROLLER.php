<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\USUARIO; // Add this import statement
use DateTime;
use Illuminate\Support\Facades\Validator; // Add this import statement
use Illuminate\Support\Facades\Log; // Add this import statement

class USUARIO__CONTROLLER extends Controller
{
    //
    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'passwrd' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'passwrd' => $request->paswrd])) {
            // Authentication successful
            $user = Auth::user();

            // Generate a token (you may have your own token generation logic)
            $token = bin2hex(random_bytes(30));


            return response()->json(['token' => $token]);
        }

        // Authentication failed
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    public function getUser(Request $request)
    {
        // Retrieve the authenticated user
        $user = Auth::user();


        $userData = [
            'id' => $user->id, // Add the user id to the response
            'nombre' => $user->nombre,
            'email' => $user->email,
            'passwrd' => $user->passwrd,
            'telefono' => $user->telefono,
            'fecha_nacimiento' => $user->fecha_nacimiento,
            'token' => $request->bearerToken(),
        ];

        return response()->json($userData);
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|',
            'email' => 'required|email|unique:USUARIOS,email|',
            'passwrd' => 'required|min:8|max:20|',
            'fecha_nacimiento' => 'required|date|before:today|after:01-01-1925|',
            'telefono' => 'required|string|max:10|',


        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $fecha_nacimiento = $request->fecha_nacimiento;
        Log::info('Raw fecha_nacimiento:', ['value' => $fecha_nacimiento]);
       
        // Create a new user
        $user = USUARIO::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'passwrd' => bcrypt($request->passwrd),
            'telefono' => $request->telefono,
            'fecha_nacimiento' => $fecha_nacimiento,
        ]);

        $token = bin2hex(random_bytes(30));

        return response()->json(['token' => $token]);
    }
}
