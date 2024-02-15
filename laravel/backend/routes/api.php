<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\discoController;
use App\Http\Controllers\reviewController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Auth;


Route::get('/csrf-token', function () {
    return csrf_token();
});

Route::middleware(['api'])->group(function () {
    Route::get('/user', function() {
        return Auth::user();
    })->middleware('auth');

    Route::post('/login', [userController::class, 'login']);
    Route::post('/register', [userController::class, 'register']);
});




//ruta para obtener todos los usuarios
Route::get('/users', [userController::class, 'getUsers']);
// ruta para obtener todas las discotecas
Route::get('/discotecas', [discoController::class, 'getDiscotecas']);
// ruta para obtener una discoteca por id
Route::get('/discotecas/{id}', [discoController::class, 'getDiscoteca']);
// ruta para crear una discoteca
Route::post('/discotecas', [discoController::class, 'createDiscoteca']);
// ruta para actualizar una discoteca
Route::put('/discotecas/{id}', [discoController::class, 'updateDiscoteca']);
// ruta para borrar una discoteca
Route::delete('/discotecas/{id}', [discoController::class, 'deleteDiscoteca']);
// ruta para obtener las discotecas por nombre
Route::get('/discotecas/nombre/{nombre_local}', [discoController::class, 'getDiscotecasByName']);
// ruta para obtener las discotecas por edad
Route::get('/discotecas/edad/{minEdad}', [discoController::class, 'getDiscotecasByAge']);
// ruta para obtener las discotecas por horario
Route::get('/discotecas/horario/{horario}', [discoController::class, 'getDiscotecasBySchedule']);


// ruta para crear una review
Route::post('/reviews', [reviewController::class, 'createReview']);
// ruta para obtener todas las reviews
Route::get('/reviews', [reviewController::class, 'getReviews']);
// ruta para obtener todas las reviews de una discoteca pasando el id
Route::get('/discoreviews/{id}', [reviewController::class, 'getDiscoReviews']);
// ruta para obtener una review por id
Route::get('/review/{id}', [reviewController::class, 'getReview']);
// ruta para actualizar una review
Route::put('/reviews/{id}', [reviewController::class, 'update']);
// ruta para borrar una review
Route::delete('/reviews/{id}', [reviewController::class, 'delete']);
// ruta para obtener las reviews por id de usuario
Route::get('/reviews/user/{id}', [reviewController::class, 'getReviewsByUser']);
// ruta para obtener las reviews por id de discoteca
Route::get('/reviews/disco/{id}', [reviewController::class, 'getReviewsByDisco']);
// ruta para obtener las reviews por puntuacion
Route::get('/reviews/puntuacion/{puntuacion}', [reviewController::class, 'getReviewsByPuntuacion']);

