<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->char('nik',16)->unique();
            $table->string('alamat');
            $table->date('tanggal_lahir');
            $table->enum('jabatan', ['kasir','divisi_penjadwalan','divisi_pengadaan', 'supir', 'Super Admin']);
            $table->char('telepon', 13);
            $table->enum('status', ['Aktif','Sakit','Non Aktif'])->default('Aktif');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('karyawan');
        Schema::enableForeignKeyConstraints();
    }
}
