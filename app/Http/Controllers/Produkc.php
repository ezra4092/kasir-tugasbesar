<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;

class Produkc extends Controller
{
    public function index(){
        return view('admin.penjualan', [
            'data' => Produk::all(),
            'title' => 'Produk'
        ]);
    }

    public function save(Request $request){
        $produk = new Produk();
        $produk->namaproduk = $request->namaproduk;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->save();
        return redirect()->route('produk')->with('dataTambah', 'Data Berhasil Di Tambah');
    }

    public function delete(Request $request){
        $produk = Produk::where('idproduk', $request->idproduk);
        $produk->delete();
        return redirect()->route('produk')->with('dataHapus', 'Data Berhasil Di Hapus');
    }

    public function edit(Request $request){
        // dd($request->all());
        $produk = Produk::find($request->idproduk);
        $produk->update([
            'namaproduk' => $request->namaproduk,
            'harga' => $request->harga,
            'stok' => $request->stok
        ]);
        $produk->save();
        return redirect()->route('produk')->with('dataEdit', 'Data Berhasil Di Edit');
    }
}
