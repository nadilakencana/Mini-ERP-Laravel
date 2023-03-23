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
        'keterangan',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
