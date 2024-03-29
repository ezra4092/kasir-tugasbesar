<?php

namespace App\Http\Controllers;
use App\Models\StokModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Admin extends Controller
{
    public function index() {
        $stok = StokModel::all();
        $data = [
            'title' => 'Kasir Dapur Bunda',
            'active' => 'Stok',
            'stok' => $stok
        ];
        return view ('admin.index', $data);
    }

    public function save(Request $request){
        StokModel::create($request->except(['_token', 'simpan']));
        return redirect()->to(url('stok'))->with('dataTambah', 'Data Berhasil Di Tambah');
    }

    public function delete($id){
        StokModel::destroy($id);
        return redirect()->to(url('stok'))->with('dataDelete', 'Data Berhasil Di Hapus');
    }

    public function edit($id){
        $data = [
            'title' => 'Kasir Dapur Bunda',
            'active' => 'Stok',
            'stok' => StokModel::find($id)
        ];
        return view('stok.edit', $data);
    }

    public function update(Request $request, $id) {
        $stok = StokModel::find($id);
        $stok->update($request->except(['_token'], '_method'));

        return redirect()->to(url('stok'))->with('dataEdit', 'Data Berhasil Di Edit');
    }

    public function user() {
        $stok = User::all();
        $data = [
            'title' => 'Kasir Dapur Bunda',
            'active' => 'Stok',
            'stok' => $stok
        ];
        return view ('admin.petugas', $data);
    }

    public function kasir() {
        $stok = User::all();
        $data = [
            'title' => 'Kasir Dapur Bunda',
            'active' => 'Stok',
            'stok' => $stok
        ];
        return view ('admin.kasir.index', $data);
    }

    public function pembelian() {
        $stok = StokModel::all();
        $data = [
            'title' => 'Kasir Dapur Bunda',
            'active' => 'Stok',
            'stok' => $stok
        ];
        return view ('admin.kasir.pembelian', $data);
    }
}
