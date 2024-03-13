<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\Admin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login');
Route::post('/login/proses', [Login::class, 'proses']);
Route::get('/logout', [Login::class, 'logout'])->name('logout');


Route::group(['middleware' => ['auth']], function() {

    Route::group(['midddleware' => ['cekUserLogin:admin']], function () {
        Route::resource('admin', Admin::class);

        Route::get('/user', [Admin::class, 'showForm']);
        Route::post('/update/akun', [Admin::class, 'akun']);

        Route::get('/pembayaran', [Admin::class, 'index'])->name('pembayaran');
        Route::post('/pembayaran/save', [Admin::class, 'save']);

        Route::delete('/pembayaran/delete/{id}', [Admin::class, 'delete'])->name('pembayaran.delete');

        Route::get('/pembayaran/edit/{id}', [Admin::class, 'edit'])->name('pembayaran.edit');
        Route::put('/pembayaran/update/{id}', [Admin::class, 'update'])->name('pembayaran.update');
    });
    Route::group(['midddleware' => ['cekUserLogin:petugas']], function () {
    });
});
