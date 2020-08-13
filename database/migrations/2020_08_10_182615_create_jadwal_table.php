<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->time('jam_berangkat');
            $table->time('perkiraan_tiba');
            $table->unsignedBigInteger('id_rute');
            $table->unsignedBigInteger('id_kendaraan');
            $table->unsignedBigInteger('id_supir');
            $table->integer('harga');
            $table->timestamps();
            $table->foreign('id_rute')->references('id')->on('rute')->onDelete('cascade');
            $table->foreign('id_kendaraan')->references('id')->on('kendaraan')->onDelete('cascade');
            $table->foreign('id_supir')->references('id')->on('karyawan')->onDelete('cascade');
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
        Schema::dropIfExists('jadwal');
        Schema::enableForeignKeyConstraints();
    }
}
