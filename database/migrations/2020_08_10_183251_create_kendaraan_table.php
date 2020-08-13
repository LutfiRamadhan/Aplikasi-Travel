<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendaraanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('merk');
            $table->string('tipe_jenis');
            $table->enum('status', ['available','service','disable'])->default('available');
            $table->char('plat_nomor', 10);
            $table->integer('kapasitas');
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
        Schema::dropIfExists('kendaraan');
        Schema::enableForeignKeyConstraints();
    }
}
