<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class List_Item_Pengiriman extends Model
{
    use HasFactory;
    protected $table = 'list_item_pengiriman';
    protected $fillable = [
        'fid_surat_jalan',
        'fid_jenis_barang',
        'fid_barang',
        'fid_varian',
        'jumlah',
        'keterangan',
        'created_by',
        'updated_by'
    ];
    public $timestamp = true;

    public function pengiriman(){
        return $this->belongsTo(DetailPengiriman::class, 'fid_surat_jalan', 'id');
    }

    public function pembelian(){
        return $this->belongsTo(Penjualan::class, 'fid_pejualan', 'id');

    }

    public function jenisBarang(){
        return $this->belongsTo(Barang_jenis::class, 'fid_jenis_barang','id');
    }

    public function AliasBarang(){
        return $this->belongsTo(Barang_Alias::class,'fid_barang', 'id');
    }

    public function Varian(){
        return $this->belongsTo(Barang_Varian::class,'fid_varian','id');
    }
}
