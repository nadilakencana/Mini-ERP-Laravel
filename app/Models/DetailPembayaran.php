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
        'total_ppn',
        'keterangan',
        'dipriksa',
        'created_by',
        'updated_by',

    ];

    public $timestamp = true;

    public function admin(){
        return $this->belongsTo(User::class,'dipriksa','id');
    }

    public function penjualan(){
        return $this->belongsTo(DetailPembayaran::class,'fid_penjualan', 'id');
    }
}
