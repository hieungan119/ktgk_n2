<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MnhuController1;

Route::match(['GET', 'POST'], '/timkiem', [MnhuController1::class, 'search']);

Route::get('/', [HomeController::class, 'index']);


Route::get('/dashboard', function () {
    return redirect('/');           
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';
