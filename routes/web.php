<?php

use App\Http\Controllers\CompraController;
use App\Http\Controllers\FiltrosController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
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
    return redirect()->route('Pelicula.index');
});

Route::resource('Like', LikeController::class);
Route::resource('Pelicula', PeliculaController::class);
Route::resource('Reservacion', ReservacionController::class);
Route::resource('Usuario', UsuarioController::class);
Route::resource('Compra', CompraController::class);

Route::get('login', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'loguear'])->name('login.loguear');
Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');

Route::get('Filtro', [FiltrosController::class, 'index'])->name('Filtro.index');
Route::get('Disponibles', [FiltrosController::class, 'disponibles'])->name('Filtro.disponibles');
Route::get('SinStock', [FiltrosController::class, 'sinStock'])->name('Filtro.sinStock');
Route::post('Buscar', [FiltrosController::class, 'likeThis'])->name('Filtro.search');
Route::get('Populares', [FiltrosController::class, 'byPopulares'])->name('Filtro.populares');
Route::get('Default', [FiltrosController::class, 'byNombre'])->name('Filtro.nombre');
