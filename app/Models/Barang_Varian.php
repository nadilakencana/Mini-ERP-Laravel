<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang_Varian extends Model
{
    use HasFactory;
    protected $table = 'barang_varian';
    protected $fillable = [
        'fid_barang',
        'nama_varian',
        ];


    public $timestamp = true;

    public function barang(){
        return $this->belongsTo(Product::class, 'fid_barang','id');
    }
    public function penjualan(){
        return $this->hasMany(DetailPenjualan::class,'fid_varian','id');
    }
}
