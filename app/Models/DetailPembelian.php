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
}
