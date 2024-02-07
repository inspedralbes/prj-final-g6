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

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/check-authentication', function () {
    $user = Auth::user();

    return response(['authenticated' => $user !== null, 'user' => $user]);
});


Route::post('/check-authentication', [App\Http\Controllers\authController::class, 'checkAuthentication']);
//ruta para crear usuarios
Route::post('/register', [App\Http\Controllers\userController::class, 'register']);
//ruta para logear usuarios
Route::post('/login', [App\Http\Controllers\userController::class, 'login']);
//ruta para obtener todos los usuarios
Route::get('/users', [App\Http\Controllers\userController::class, 'getUsers']);
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


// ruta para crear una review
Route::post('/reviews', [App\Http\Controllers\reviewController::class, 'create']);
// ruta para obtener todas las reviews
Route::get('/reviews/{id}', [App\Http\Controllers\reviewController::class, 'getReviews']);
// ruta para obtener una review por id
Route::get('/review/{id}', [App\Http\Controllers\reviewController::class, 'getReview']);
// ruta para actualizar una review
Route::put('/reviews/{id}', [App\Http\Controllers\reviewController::class, 'update']);
// ruta para borrar una review
Route::delete('/reviews/{id}', [App\Http\Controllers\reviewController::class, 'delete']);
// ruta para obtener las reviews por id de usuario
Route::get('/reviews/user/{id}', [App\Http\Controllers\reviewController::class, 'getReviewsByUser']);
// ruta para obtener las reviews por id de discoteca
Route::get('/reviews/disco/{id}', [App\Http\Controllers\reviewController::class, 'getReviewsByDisco']);
// ruta para obtener las reviews por puntuacion
Route::get('/reviews/puntuacion/{puntuacion}', [App\Http\Controllers\reviewController::class, 'getReviewsByPuntuacion']);
