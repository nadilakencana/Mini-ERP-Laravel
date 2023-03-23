<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupToko extends Model
{
    use HasFactory;
    protected $table = 'user_group';
    protected $fillable = [
        'nama_toko',
        'kode_invoice',
        'alamat',
        'no_telpon',
        'logo_toko',
        'shoppee_hook',
        'tokopedia_hook',
        'created_by',
        'updated_by',

    ];

    public $timestamp = true;

    public function group_member(){
        return $this->hasMany(GroupMember::class,'fid_group', 'id');
    }
}
