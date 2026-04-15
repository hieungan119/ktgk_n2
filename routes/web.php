<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddPlantsController;

Route::get('/', [HomeController::class, 'index']);


Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';

Route::get('/caycanh/create', [AddPlantsController::class, 'create'])->name('create');
Route::post('/caycanh/store', [AddPlantsController::class, 'store'])->name('store');
