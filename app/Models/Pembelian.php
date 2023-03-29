<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $table = 'pembelian';
    protected $guarded = [];


    public $timestamp = true;
    public function suplier(){
        return $this->belongsTo(Supplier::class,'fid_supplier','id');
    }

    public function detailPembelian(){
        return $this->hasMany(DetailPembelian::class,'fid_pembelian','id');

    }

    public function Group(){
        return $this->belongsTo(GroupToko::class,'fid_group','id' );
    }

    public function admin(){
        return $this->belongsTo(User::class, 'fid_user','id');
    }

}
