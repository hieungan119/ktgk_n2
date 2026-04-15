<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);


Route::get('/dashboard', function () {
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';
use App\Http\Controllers\CayCanhController;



Route::get('/', [HomeController::class, 'index']);


Route::get('caycanh/theloai/{id}', function($id) {
    return app(HomeController::class)->index(request()->merge(['id_danh_muc' => $id]));
});


Route::get('/chi-tiet/{id}', [HomeController::class, 'detail']);

Route::post('/timkiem', [HomeController::class, 'index']);
