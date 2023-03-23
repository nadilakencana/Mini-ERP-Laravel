<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePembelian extends Model
{
    use HasFactory;
    protected $table = 'type_pembelian';
    protected $fillable = ['type' ,'description'];


    public $timestamp = true;

    public function pembelian(){
        return $this->hasMany(Pembelian::class,'id_type','id');
    }
}