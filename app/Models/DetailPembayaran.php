<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembayaran extends Model
{
    use HasFactory;
    protected $table = 'penjualan_pembayaran';
    protected $fillable = [
        'fid_penjualan',
        'tanggal',
        'pembayaran',
        'total',
        'keterangan',
        'dipriksa',
        'created_by',
        'updated_by',

    ];

    public $timestamp = true;
}
