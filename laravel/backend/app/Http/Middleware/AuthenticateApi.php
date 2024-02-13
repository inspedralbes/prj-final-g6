<?php

namespace App\Http\Middleware;

use App\Models\usuarioModel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('Authorization')) {
            $apiToken = str_replace('Bearer ', '', $request->header('Authorization'));
            $user = usuarioModel::where('api_token', $apiToken)->first();
    
            if ($user) {
                auth()->login($user);
                return $next($request);
            }
        }
    
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
