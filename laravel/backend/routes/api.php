<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\USUARIO__CONTROLLER;
use Illuminate\Support\Facades\Auth;

Route::get('/csrf-token', function () {
    return csrf_token();
});

Route::middleware(['api'])->group(function () {
    Route::get('/user', function() {
        return Auth::user();
    })->middleware('auth');

    Route::post('/login', [USUARIO__CONTROLLER::class, 'login']);
    Route::post('/register', [USUARIO__CONTROLLER::class, 'register']);
});
