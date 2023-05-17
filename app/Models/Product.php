<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $fillable = ['kode' ,'nama_barang','fid_jenis_barang','harga', 'produk_sendiri',
    'created_by','updated_by','approved','user_approved','tanggal_approved'];


    public $timestamp = true;

    public function detailpembelian(){
        return $this->hasMany(DetailPembelian::class,'id_product','id');
    }
    public function detailpenjualan(){
        return $this->hasMany(DetailPenjualan::class,'id_product','id');
    }

    public function jenis(){
        return $this->belongsTo(Barang_jenis::class, 'fid_jenis_barang','id');
    }
    public function varian(){
        return $this->hasMany(Barang_Varian::class, 'fid_barang','id');
    }
    public function alias(){
        return $this->hasMany(Barang_Alias::class, 'fid_barang','id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_approved','id');
    }

}
