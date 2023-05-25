<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_log_SJ extends Model
{
    use HasFactory;

    protected $table = 'status_log_sj';
    protected $fillable = [
       'fid_surat_jalan',
       'tanggal_cetak',
       'user_cetak',
       'cetak_ke',
       'status'
    ];
    public $timestamp = true;
}
