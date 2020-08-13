<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';
    protected $fillable = ['merk', 'tipe_jenis', 'status', 'plat_nomor', 'kapasitas'];
}
