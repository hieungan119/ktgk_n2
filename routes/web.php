<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ControllerNhien;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [ControllerNhien::class, 'index']);
Route::get('/home', [ControllerNhien::class, 'index']);
Route::get('home/detail/{id}','App\Http\Controllers\ControllerNhien@detail');
Route::post('/cart/add', 'App\Http\Controllers\ControllerNhien@cartadd')->name('cartadd');
Route::get('/gio-hang', [ControllerNhien::class, 'order'])->name('order');
Route::post('/cart/delete','App\Http\Controllers\ControllerNhien@cartdelete')->name('cartdelete');
Route::post('/order/create','App\Http\Controllers\ControllerNhien@ordercreate') ->middleware('auth')->name('ordercreate');
Route::get('/testemail','App\Http\Controllers\ControllerNhien@testemail');



Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';
