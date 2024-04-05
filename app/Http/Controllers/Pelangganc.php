<?php

namespace App\Http\Controllers;
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

        return redirect()->route('penjualan')->with(['tambah' => true, 'message' => 'Data Berhasil ditambah']);
    }

    public function delete(Request $request){
        $pelanggan = Pelanggan::where('idpelanggan', $request->idpelanggan);
        $pelanggan->delete();
        return redirect()->route('penjualan')->with(['delete' => true, 'message' => 'Data Berhasil dihapus']);
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
        return redirect()->route('penjualan')->with(['edit' => true, 'message' => 'Data Berhasil diedit']);
    }

}
