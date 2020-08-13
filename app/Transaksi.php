<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = ['no_transaction', 'nama_penumpang', 'nomor_telepon', 'status', 'id_jadwal', 'seat_number'];

    public function Jadwal() {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }
}
