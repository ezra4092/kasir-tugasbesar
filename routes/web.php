<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Loginc;
use App\Http\Controllers\Produkc;
use App\Http\Controllers\Userc;
use App\Http\Controllers\Pelangganc;
use App\Http\Controllers\Detailc;
use App\Http\Controllers\Dashboardc;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Route::post('/proses', [Loginc::class, 'login'])->name('proses');


Route::group(['middleware' => ['auth']], function() {
    Route::get('/logout', [Loginc::class, 'logout'])->name('logout');

    Route::get('/dashboard', [Dashboardc::class, 'index'])->name('dashboard');

    Route::get('/produk', [Produkc::class, 'index'])->name('produk');
    Route::post('/produk/save', [Produkc::class, 'save'])->name('produk-save');
    Route::post('/produk/delete', [Produkc::class, 'delete'])->name('produk-delete');
    Route::post('/produk/edit', [Produkc::class, 'edit'])->name('produk-edit');

    Route::get('/user', [Userc::class, 'index'])->name('user');
    Route::post('/user/save', [Userc::class, 'save'])->name('user-save');
    Route::post('/user/delete', [Userc::class, 'delete'])->name('user-delete');
    Route::post('/user/edit', [Userc::class, 'edit'])->name('user-edit');

    Route::get('/penjualan', [Pelangganc::class, 'index'])->name('penjualan');
    Route::post('/pelanggan/save', [Pelangganc::class, 'save'])->name('cust-save');
    Route::post('/pelanggan/delete', [Pelangganc::class, 'delete'])->name('cust-delete');
    Route::post('/pelanggan/edit', [Pelangganc::class, 'edit'])->name('cust-edit');

    Route::get('/detailpenjualan', [Detailc::class, 'index'])->name('detail');
    Route::get('/detailpenjualan/{id}', [Detailc::class, 'detail']);
    Route::post('/detailpenjualan/save', [Detailc::class, 'save']);
});
