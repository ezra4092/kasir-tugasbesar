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
Route::post('/login/proses', [Login::class, 'proses'])->name('proses');
Route::get('/logout', [Login::class, 'logout'])->name('logout');


Route::group(['middleware' => ['auth']], function() {

    Route::group(['midddleware' => ['cekUserLogin:admin']], function () {
        Route::resource('admin', Admin::class);

        Route::get('/stok', [Admin::class, 'index'])->name('stok');
        Route::post('/stok/save', [Admin::class, 'save']);
        Route::delete('/stok/delete/{id}', [Admin::class, 'delete'])->name('stok.delete');
        Route::get('/stok/edit/{id}', [Admin::class, 'edit'])->name('stok.edit');
        Route::put('/stok/update/{id}', [Admin::class, 'update'])->name('stok.update');

    });
    Route::group(['midddleware' => ['cekUserLogin:petugas']], function () {
    });
});
