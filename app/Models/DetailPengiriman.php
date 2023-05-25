<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengiriman extends Model
{
    use HasFactory;
    protected $table = 'penjualan_pengiriman';
    protected $fillable =[
        'fid_penjualan',
        'no_surat_jalan',
        'tanggal_sj',
        'type',
        'tanggal_kirim',
        'alamat',
        'customer',
        'pengiriman',
        'jenis_surat_jalan',
        'keterangan',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    public function SO(){
        return $this->belongsTo(Penjualan::class, 'fid_penjualan', 'id');
    }

    public function Admin(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }


}
