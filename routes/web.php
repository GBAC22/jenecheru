<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\ArticulosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Livewire\Articulos;

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

    // Asegúrate de que todos estos métodos existan en los controladores correspondientes
    Route::get('/users/{user}/bitacora', [UsersController::class, 'showBitacora'])->name('users.bitacora');
    Route::get('/users/clientes', [UsersController::class, 'clientes'])->name('users.clientes');

});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', UsersController::class);
    Route::resource('marca', MarcaController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::get('/users/clientes', [UsersController::class, 'clientes'])->name('users.clientes');


    // Para Livewire componentes normalmente no se definen de esta manera
    Route::resource('articulos', Articulos::class);

    Route::resource('inventario', ArticulosController::class);
    Route::get('/users/{user}/bitacora', [UsersController::class, 'showBitacora'])->name('users.bitacora');

});
