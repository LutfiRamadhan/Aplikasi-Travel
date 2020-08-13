<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaction');
            $table->string('nama_penumpang');
            $table->string('nomor_telepon');
            $table->char('status', 10);
            $table->unsignedBigInteger('id_jadwal');
            $table->integer('seat_number');
            $table->timestamps();
            $table->foreign('id_jadwal')->references('id')->on('jadwal')->onDelete('cascade');
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
        Schema::dropIfExists('transaksi');
        Schema::enableForeignKeyConstraints();
    }
}
