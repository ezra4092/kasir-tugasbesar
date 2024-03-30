<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'tanggal',
        'totalharga',
        'idpelanggan',
    ];

    protected $primaryKey = 'idpelanggan';

    public $timestamps = false;


    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'idpelanggan', 'idpelanggan');
    }

    public function detailpenjualan(){
       return $this->hasMany(DetailPenjualan::class, 'idpelanggan', 'idpelanggan');
    }
}
