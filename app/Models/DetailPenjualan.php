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
    public function jenis(){
        return $this->belongsTo(Barang_jenis::class,'fid_jenis_barang', 'id');
    }
    public function variasi(){
        return $this->belongsTo(Barang_Varian::class,'fid_varian', 'id');
    }
    public function alias(){
        return $this->belongsTo(Barang_Alias::class,'fid_barang', 'id');
    }
}
