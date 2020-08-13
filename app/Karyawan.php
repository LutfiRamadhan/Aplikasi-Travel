<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';
    
    protected $fillable = ['nama', 'nik', 'alamat', 'tanggal_lahir', 'jabatan', 'telepon', 'status'];
}
