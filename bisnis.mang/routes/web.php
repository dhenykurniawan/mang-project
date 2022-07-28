<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\KontenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StateController;


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

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::middleware(['guest'])->group(function(){
  Route::name('auth.')->prefix('auth')->group(function(){
        Route::get('/login', [AuthController::class, 'index'])->name('index');
  });
});

Route::middleware(['check.login'])->group(function(){

      Route::name('cart.')->prefix('cart')->group(function(){
          Route::post('/store_address', [CartController::class, 'store_address'])->name('store_address');
          Route::post('/store_confirm', [CartController::class, 'store_confirm'])->name('store_confirm');
          Route::post('/get_ongkir', [CartController::class, 'get_ongkir'])->name('get_ongkir');
          Route::post('/update_address', [CartController::class, 'update_address'])->name('update_address');
          Route::get('/address', [CartController::class, 'address'])->name('address');
          Route::get('/form_address', [CartController::class, 'form_address'])->name('form_address');
          Route::get('/confirm', [CartController::class, 'confirm'])->name('confirm');
          Route::get('/done', [CartController::class, 'done'])->name('done');
          
    });

    Route::name('order.')->prefix('order')->group(function(){
          Route::post('/store', [OrderController::class, 'store'])->name('store');
          Route::post('/get_order_data', [OrderController::class, 'get_order_data'])->name('get_order_data');
          Route::get('/process', [OrderController::class, 'process'])->name('process');
          Route::get('/finish', [OrderController::class, 'finish'])->name('finish');
          Route::get('/cancel', [OrderController::class, 'cancel'])->name('cancel');
          Route::get('/history', [OrderController::class, 'history'])->name('history');
    });

    Route::name('auth.')->prefix('auth')->group(function(){
          Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    });

  });


Route::get("/",[WelcomeController::class,"index"])->name("index");

  Route::name('state.')->prefix('state')->group(function(){
        Route::post('/get_kota', [StateController::class, 'get_kota'])->name('get_kota');
        Route::post('/get_kecamatan', [StateController::class, 'get_kecamatan'])->name('get_kecamatan');
        Route::post('/get_kelurahan', [StateController::class, 'get_kelurahan'])->name('get_kelurahan');
  });

  Route::name('home.')->prefix('home')->group(function(){
        Route::post('/get_produk', [WelcomeController::class, 'get_produk'])->name('get_produk');
  });


 Route::name('resep.')->prefix('resep')->group(function(){
        Route::get('/', [ResepController::class, 'index'])->name('index');
        Route::get('/detail', [ResepController::class, 'detail'])->name('detail');
  });

  Route::name('konten.')->prefix('konten')->group(function(){
        Route::get('/', [KontenController::class, 'index'])->name('index');
        Route::get('/detail', [KontenController::class, 'detail'])->name('detail');
  });

  Route::name('auth.')->prefix('auth')->group(function(){
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
        Route::post('/get_user_data', [AuthController::class, 'get_user_data'])->name('get_user_data');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
  });

  
   Route::name('cart.')->prefix('cart')->group(function(){
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/store', [CartController::class, 'store'])->name('store');
        Route::post('/delete', [CartController::class, 'delete'])->name('delete');
        Route::post('/get_produk', [CartController::class, 'get_produk'])->name('get_produk');
        Route::post('/get_data', [CartController::class, 'get_data'])->name('get_data');
  });

  Route::get('public', function() { return redirect('/'); });
   
  Route::any('{query}', function() { return redirect('/'); })->where('query', '.*');


  
 
