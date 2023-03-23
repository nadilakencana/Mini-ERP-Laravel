<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan_detail';
    protected $fillable = [
        'fid_penjualan',
        'fid_jenis_barang',
        'fid_barang',
        'fid_varian',
        'jumlah',
        'harga_satuan',
        'total',
        'keterangan'
    ];


    public $timestamp = false;

    public function penualan(){
        return $this->belongsTo(Penjualan::class,'id_penjualan','id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'id_product','id');
    }
}
