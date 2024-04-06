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
        $idPenjualan = Penjualan::where('idpelanggan', $id)->value('idpenjualan');
        $data = [
            'data' => DetailPenjualan::where('idpenjualan', $idPenjualan)->get(),
            'title' => 'Detail',
            'produk' => Produk::all(),
            'pelanggan' => Pelanggan::where('idpelanggan', $id)->value('namacust'),
            'idPelanggan' => $id,
            'total' => Penjualan::where('idpenjualan', $idPenjualan)->value('totalharga')
        ];
        return view('admin.kasir.detail', $data);
    }

    public function save(Request $request){

        $harga = Produk::where('idproduk', $request->idproduk)->value('harga');
        $idPenjualan = Penjualan::where('idpelanggan', $request->idPelanggan)->value('idpenjualan');

        
        $detail = new DetailPenjualan();
        $detail->idpenjualan = $idPenjualan;
        $detail->idproduk = $request->idproduk;
        $detail->jumlahproduk = $request->stok;
        $detail->subtotal = $request->stok * $harga;
        $detail->save();

        $produk = Produk::find($request->idproduk);
        $produk->stok -= $request->stok;
        $produk->save();

        $penjualan = Penjualan::where('idpelanggan', $request->idPelanggan)->first();
        $penjualan->totalharga += $request->stok * $harga;
        $penjualan->save();

        return redirect()->back();
    }
}
