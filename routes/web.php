<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ControllerNhien;
use App\Http\Controllers\MnhuController1;
use App\Http\Controllers\AddPlantsController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\CayCanhController;
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
Route::match(['GET', 'POST'], '/timkiem', [MnhuController1::class, 'search']);

Route::get('/dashboard', function () {
    return redirect('/');           

})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/caycanh/list', [ManagementController::class, 'list_caycanh'])->name('caycanh.list');


Route::get('/caycanh/create', [AddPlantsController::class, 'create'])->name('create');
Route::post('/caycanh/store', [AddPlantsController::class, 'store'])->name('store');

Route::get('caycanh/theloai/{id}', function($id) {
    return app(HomeController::class)->index(request()->merge(['id_danh_muc' => $id]));
});

Route::post('/caycanh/delete/{id}', [ManagementController::class, 'delete_caycanh'])->name('caycanh.delete');

Route::get('/caycanh/detail/{id}', [ManagementController::class, 'detail_caycanh'])->name('caycanh.detail');

