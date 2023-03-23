<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPersonCustomer extends Model
{
    use HasFactory;
    protected $table= 'customer_contact';
    protected $fillable = [
        'fid_customer',
        'nama_lengkap',
        'jabatan',
        'departement',
        'email',
        'no_hp',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'

    ];

    public function customers(){
        return $this->belongsTo(Customer::class, 'fid_customer', 'id');
    }
}
