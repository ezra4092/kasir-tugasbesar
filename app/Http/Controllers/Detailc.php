<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class Detailc extends Controller
{
    public function index(){
        return view('admin.kasir.detail', [
            'data' => DetailPenjualan::all(),
            'title' => 'Penjualan'
        ]);
    }

    public function detail($id){
        $idPnjualan = Penjualan::where('idpelanggan', $id)->value('idpelanggan');
        $data = [
            'data' => DetailPenjualan::where('idpenjualan', $id)->get(),
            'title' => 'Detail',
            'produk' => Produk::all(),
            'pelanggan' => Pelanggan::where('idpelanggan', $idPnjualan)->value('namacust')
        ];
        return view('admin.kasir.detail', $data);
    }
}
