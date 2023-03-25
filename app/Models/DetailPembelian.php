<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    use HasFactory;
    protected $table = 'pembelian_detail';
    protected $fillable = [
        'fid_pembelian' ,
        'fid_jenis_barang',
        'fid_barang',
        'fid_varian',
        'jumlah',
        'harga_satuan',
        'total',
        'keterangan',
    ];


    public $timestamp = false;

    public function pembelian(){
        return $this->belongsTo(Pembelian::class,'fid_pembelian','id');

    }

    public function product(){
        return $this->belongsTo(Product::class,'fid_barang','id');
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
