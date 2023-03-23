<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    protected $fillable= [
        'nama_supplier',
        'alamat',
        'npwp',
        'email',
        'no_hp',
        'created_by',
        'updated_by',

    ];

    public $timestamp = true;

    public function detail_contact_sp(){
        return $this->hasMany(ContactPersonSupplier::class, 'fid_supplier', 'id');
    }
}