<?php

use App\Http\Livewire\Articulos;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\CategoriaController;

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
    Route::resource('/marca',MarcaController::class);
    Route::resource('modelos', ModeloController::class);  
    Route::resource('categorias', CategoriaController::class);
    Route::get('/users/clientes', [UsersController::class, 'clientes'])->name('users.clientes');


    // Para Livewire componentes normalmente no se definen de esta manera
    Route::resource('articulos', Articulos::class);
    Route::resource('inventario', ArticulosController::class);
    Route::get('/users/{user}/bitacora', [UsersController::class, 'showBitacora'])->name('users.bitacora');

    //pagos con stripe
    Route::get('/pagos/checkout', [StripeController::class, 'checkout'])->name('pagos.checkout');
    Route::get('/checkout', [StripeController::class, 'checkout'])->name('checkout');
    Route::post('/session', 'App\Http\Controllers\StripeController@session')->name('session');
    Route::get('/success', 'App\Http\Controllers\StripeController@success')->name('success');
    

    //carrito de compras  
    Route::post('add-to-cart', [ArticulosController::class, 'addToCart'])->name('add_to_cart');
    Route::get('pagos/carrito-index', [ArticulosController::class, 'cart'])->name('pagos.carrito-index');
    Route::post('update-cart', [ArticulosController::class, 'updateCart'])->name('update_cart');
    Route::post('remove-from-cart', [ArticulosController::class, 'removeFromCart'])->name('remove_from_cart');
    Route::post('clear-cart', [ArticulosController::class, 'clearCart'])->name('clear_cart');

    //factura del carrito
    Route::get('/invoice', [InvoiceController::class, 'print'])->name('invoice.print');

    Route::resource('inventario', ArticulosController::class);
    Route::get('/users/{user}/bitacora', [UsersController::class, 'showBitacora'])->name('users.bitacora');

});
