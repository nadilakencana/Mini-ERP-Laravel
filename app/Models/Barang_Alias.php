<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang_Alias extends Model
{
    use HasFactory;
    protected $table = 'barang_alias';
    protected $fillable = [
        'fid_barang',
        'fid_group',
        'alias',
        ];


    public $timestamp = true;
    public function barang(){
        return $this->belongsTo(Product::class, 'fid_barang','id');
    }

    public function group(){
        return $this->belongsTo(GroupToko::class,'fid_group','id');
    }
}