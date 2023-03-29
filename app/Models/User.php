<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'user';
    protected $fillable = [
        'username',
        'nama',
        'email',
        'password',
        'no_hp',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function group_member()
    {
        return $this->hasMany(GroupMember::class, 'fid_user','id');
    }

    public function role_admin(){
        return $this->belongsTo(User_Role::class, 'role','id');
    }

    public function log(){
        return $this->hasMany(User_Log::class,'fid_user', 'id');
    }

    public function pembayaran(){
        return $this->hasMany(DetailPembayaran::class,'dipriksa','id');
    }
}
