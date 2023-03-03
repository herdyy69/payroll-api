<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_laporans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_laporan');
            $table->unsignedBigInteger('karyawan_id');
            $table->foreign('karyawan_id')->references('id')->on('karyawans');
            $table->integer('gaji_pokok');
            $table->integer('bonus');
            $table->integer('potongan_izin');
            $table->integer('potongan_sakit');
            $table->integer('potongan_alpa');
            $table->integer('total_potongan');
            $table->integer('total_gaji');
            $table->date('tanggal_laporan');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_laporans');
    }
};
