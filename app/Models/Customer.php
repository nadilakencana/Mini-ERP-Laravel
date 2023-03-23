<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $fillable = [
        'nama_customer' ,
        'alamat',
        'npwp',
        'email',
        'no_hp',
        'created_by',
        'updated_by',

    ];


    public $timestamp = true;

    public function penjualan(){
        return $this->hasMany(Penjualan::class,'id_customer','id');

   }

   public function detail_customer(){
    return $this->hasMany(ContactPersonCustomer::class, 'fid_customer', 'id');
   }
}
