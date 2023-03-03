<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pegawai');
            $table->string('nik', 16)->unique();
            $table->string('alamat');
            $table->string('no_telp');
            $table->string('email');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('status_hubungan', ['Menikah', 'Belum Menikah']);
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']);
            $table->string('foto')->nullable();
            $today = Carbon::today();
            $table->date('tanggal_masuk')->default($today);
            $table->date('tanggal_keluar')->nullable();
            $table->string('lama_kerja')->nullable();
            $table->string('keterangan')->nullable();
            // rekening
            $table->enum('nama_bank', [
                'CIMB NIAGA',
                ]
            )->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('atas_nama')->nullable();
            // end rekening
            $table->enum('pegawai', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->unsignedBigInteger('jabatan_id');
            $table->foreign('jabatan_id')->references('id')->on('jabatans');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('statuses');
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
        Schema::dropIfExists('karyawans');
    }
};
