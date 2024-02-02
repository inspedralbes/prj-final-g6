<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//ruta para crear usuarios
Route::post('/register', [App\Http\Controllers\usuarioController::class, 'register']);
//ruta para logear usuarios
Route::post('/login', [App\Http\Controllers\usuarioController::class, 'login']);
//ruta para obtener todos los usuarios
Route::get('/users', [App\Http\Controllers\usuarioController::class, 'getUsers']);
// ruta para obtener todas las discotecas
Route::get('/discotecas', [App\Http\Controllers\discoController::class, 'getDiscotecas']);
// ruta para obtener una discoteca por id
Route::get('/discotecas/{id}', [App\Http\Controllers\discoController::class, 'getDiscoteca']);
// ruta para crear una discoteca
Route::post('/discotecas', [App\Http\Controllers\discoController::class, 'createDiscoteca']);
// ruta para actualizar una discoteca
Route::put('/discotecas/{id}', [App\Http\Controllers\discoController::class, 'updateDiscoteca']);
// ruta para borrar una discoteca
Route::delete('/discotecas/{id}', [App\Http\Controllers\discoController::class, 'deleteDiscoteca']);
// ruta para obtener las discotecas por nombre
Route::get('/discotecas/nombre/{nombre_local}', [App\Http\Controllers\discoController::class, 'getDiscotecasByName']);
// ruta para obtener las discotecas por edad
Route::get('/discotecas/edad/{minEdad}', [App\Http\Controllers\discoController::class, 'getDiscotecasByAge']);
// ruta para obtener las discotecas por horario
Route::get('/discotecas/horario/{horario}', [App\Http\Controllers\discoController::class, 'getDiscotecasBySchedule']);
