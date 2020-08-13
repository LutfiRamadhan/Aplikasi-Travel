<?php

use Illuminate\Database\Seeder;

class KaryawanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Karyawan::create([
            'nama' => 'Lutfi Ramadhan',
            'nik' => '3277012912990019',
            'alamat' => 'Street Fighter',
            'tanggal_lahir' => '1998-12-29',
            'jabatan' => 'Super Admin',
            'telepon' => '081313088117',
            'status' => 'Aktif'
        ]);
    }
}
