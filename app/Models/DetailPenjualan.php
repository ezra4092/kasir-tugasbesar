<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;
    protected $table = 'detailpenjualan';

    protected $fillable = [
        'idpenjualan',
        'idproduk',
        'jumlahproduk',
        'subtotal',
    ];

    protected $primaryKey = 'iddetail';

    public $timestamps = false;


    public function penjualan(){
       return $this->belongsTo(Penjualan::class, 'idpenjualan', 'idpenjualan');
    }

    public function produk(){
        return $this->belongsTo(Produk::class, 'idproduk', 'idproduk');
     }
}
