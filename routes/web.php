<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ControllerNhien;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\CayCanhController;

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

})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/caycanh/list', [ManagementController::class, 'list_caycanh'])->name('caycanh.list');


Route::get('caycanh/theloai/{id}', function($id) {
    return app(HomeController::class)->index(request()->merge(['id_danh_muc' => $id]));
});

Route::post('/caycanh/delete/{id}', [ManagementController::class, 'delete_caycanh'])->name('caycanh.delete');

Route::get('/caycanh/detail/{id}', [ManagementController::class, 'detail_caycanh'])->name('caycanh.detail');
