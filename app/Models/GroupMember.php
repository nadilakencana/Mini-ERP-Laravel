<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;
    protected $table = 'user_group_member';
    protected  $fillable = [
        'fid_user',
        'fid_group',

    ];
    public $timestamp = true;

    public function group(){
        return $this->belongsTo(GroupToko::class, 'fid_group', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'fid_user','id');
    }

}