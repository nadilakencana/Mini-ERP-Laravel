<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Log extends Model
{
    use HasFactory;
    protected $table = 'user_role';
    protected $fillable = [
        'fid_user',
        'log'
    ];

    public $timestamp = true;

    public function user(){
        return $this->belongsTo(User::class,'fid_user', 'id');
    }

}