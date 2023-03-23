<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPersonSupplier extends Model
{
    use HasFactory;
    protected $table = 'supplier_contact';
    protected $fillable = [
        'fid_supplier',
        'nama_lengkap',
        'jabatan',
        'departemen',
        'email',
        'no_hp',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    public function suplier(){
        return $this->belongsTo(Supplier::class, 'fid_supplier', 'id');
        
    }
}
