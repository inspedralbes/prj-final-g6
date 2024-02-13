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
<<<<<<< HEAD
<<<<<<< HEAD



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
Route::post('/reviews', [App\Http\Controllers\reviewController::class, 'createReview']);
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
=======
>>>>>>> 5331604d (autoritzacio amb pinia, falta solucionar format fecha_nacimiento)
=======
>>>>>>> 4fac5840fad90a6ce920a7a4cd77202e39099150
