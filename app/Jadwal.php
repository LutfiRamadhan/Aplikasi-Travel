<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    
    protected $fillable = ['jam_berangkat', 'perkiraan_tiba', 'id_rute', 'id_kendaraan', 'id_supir', 'harga', 'tanggal'];

    public function Rute() {
        return $this->belongsTo(Rute::class, 'id_rute');
    }

    public function Kendaraan() {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan');
    }

    public function Supir() {
        return $this->belongsTo(Karyawan::class, 'id_supir');
    }
}