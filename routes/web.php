<?php


use App\Http\Livewire\ArticulosController;
use App\Http\Controllers\ArticulosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UsersController;

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


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/', [TasksController::class, ''])->name('');
    
    Route::get('/', [UsersController::class, ''])->name('');

    Route::get('/articulos', [ArticulosController::class, 'home'])->name('articulo.home');

});

/*

// web.php
use App\Http\Controllers\UsersController;

Route::get('/users/{user}/bitacora', [UsersController::class, 'showBitacora'])->name('users.bitacora');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {

    Route::resource('users', \App\Http\Controllers\UsersController::class);


    Route::resource('categorias', \App\Http\Controllers\CategoriaController::class);

    Route::resource('articulos', \App\Http\Livewire\Articulos::class);
    //Route::get('/',function(){
      //  return view('homearti');
    //});
});*/
    Route::resource('inventario', \App\Http\Controllers\ArticulosController::class);


});

