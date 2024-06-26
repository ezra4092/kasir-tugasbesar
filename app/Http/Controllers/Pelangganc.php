<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class Pelangganc extends Controller
{
    public function index(){
        return view('admin.kasir.index', [
            'data' => Pelanggan::all(),
            'title' => 'Penjualan'
        ]);
    }

    public function save(Request $request){
        $pelanggan = new Pelanggan();
        $pelanggan->namacust = $request->namacust;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->notelp = $request->notelp;
        $pelanggan->save();

        $idPelanggan = Pelanggan::where('alamat', $request->alamat)->value('idpelanggan');

        $penjualan = new Penjualan();
        $penjualan->tanggal = Carbon::now();
        $penjualan->totalharga = 0;
        $penjualan->idpelanggan = $idPelanggan;
        $penjualan->save();

        return redirect()->route('penjualan')->with('dataTambah', 'Data Berhasil Di Tambah');
    }

    public function delete(Request $request){
        $idpenjualan = Penjualan::where('idpelanggan', $request->idpelanggan)->value('idpenjualan');

        $detailpenjualan = DetailPenjualan::where('idpenjualan', $idpenjualan);
        $pelanggan = Pelanggan::where('idpelanggan', $request->idpelanggan);
        $penjualan = Penjualan::where('idpelanggan', $request->idpelanggan);

        $detailpenjualan->delete();
        $penjualan->delete();
        $pelanggan->delete();
        return redirect()->route('penjualan')->with('dataHapus', 'Data Berhasil Di Hapus');
    }

    public function edit(Request $request){
        // dd($request->all());
        $pelanggan = Pelanggan::find($request->idpelanggan);
        $pelanggan->update([
            'namacust' => $request->namacust,
            'alamat' => $request->alamat,
            'notelp' => $request->notelp
        ]);
        $pelanggan->save();
        return redirect()->route('penjualan')->with('dataEdit', 'Data Berhasil Di Edit');
    }

}
