<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembayaranPembelian extends Model
{
    use HasFactory;
    protected $table = 'pembelian_pembayaran';
    protected $fillable = [
        'fid_pembelian',
        'tanggal',
        'pembayaran',
        'total',
        'keterangan',
        'diperiksa',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
