<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $guarded =[];
     // protected $fillable = [
    //     'no_faktur' ,
    //     'fid_group',
    //     'fid_user',
    //     'fid_customer',
    //     'tanggal',
    //     'tanggal_kirim',
    //     'konfirmasi_customer',
    //     'jenis_pengiriman',
    //     'keterangan',
    //     'sub_total',
    //     'diskon_nominal',
    //     'biaya_lain_lain',
    //     'ppn',
    //     'grand_total',
    //     'created_by',
    //     'created_at',
    //     'updated_at',
    //     'updated_by',
    //     'batal',
    //     'approval',
    //     'fid_user_approval',
    //     'alasan_pembatalan'

    // ];


    public $timestamp = true;
    public function customer(){
        return $this->belongsTo(Customer::class,'fid_customer','id');
    }

    public function penjualan(){
        return $this->hasMany(Penjualan::class,'id_penjualan', 'id');
    }
}
