<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang_jenis extends Model
{
    use HasFactory;
    protected $table = 'barang_jenis';
    protected $fillable = [
        'nama_jenis',
        ];


    public $timestamp = true;


    public function barang(){
        return $this->hasMany(Product::class, 'fid_jenis_barang','id');
    }
    public function penjualan(){
        return $this->hasMany(DetailPenjualan::class,'fid_jenis_barang','id');
    }

    public function varian(){
        return $this->hasMany(Barang_Varian::class, 'fid_jenis_barang','id');
    }
}
