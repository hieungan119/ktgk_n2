<?php
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagementController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {

})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/caycanh/list', [ManagementController::class, 'list_caycanh'])->name('caycanh.list');

Route::post('/caycanh/delete/{id}', [ManagementController::class, 'delete_caycanh'])->name('caycanh.delete');

Route::get('/caycanh/detail/{id}', [ManagementController::class, 'detail_caycanh'])->name('caycanh.detail');