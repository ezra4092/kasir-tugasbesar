<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use Illuminate\Http\Request;

class Detailc extends Controller
{
    public function index(){
        return view('admin.kasir.detail', [
            'data' => DetailPenjualan::all(),
            'title' => 'Penjualan'
        ]);
    }
}
