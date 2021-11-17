<?php

use App\Http\Controllers\LikeController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('Like', LikeController::class);
Route::resource('Pelicula', PeliculaController::class);
Route::resource('Reservacion', ReservacionController::class);
Route::resource('Usuario', UsuarioController::class);
