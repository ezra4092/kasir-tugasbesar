<?php

namespace App\Http\Controllers;
use App\Models\Penjualan;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Http\Request;

class Dashboardc extends Controller
{
    public function index(){
        $totalHarga = Penjualan::sum('totalharga');
        $jumlahPetugas = User::count('username');
        $jumlahProduk = Produk::count('namaproduk');

        return view('admin.dashboard', [
            'data' => Penjualan::all(),
            'title' => 'Produk',
            'totalHarga' => $totalHarga,
            'jumlahPetugas' => $jumlahPetugas,
            'jumlahProduk' => $jumlahProduk,
        ]);
    }
}
