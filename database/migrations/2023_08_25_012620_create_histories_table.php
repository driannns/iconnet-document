<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat');
            $table->string('date');
            $table->string('divisi');
            $table->string('jumlah');
            $table->string('nama_karyawan');
            $table->string('jenis_pekerjaan');
            $table->string('lokasi');
            $table->string('tanggalpekerjaan');
            $table->string('dari');
            $table->string('sampai');
            $table->string('persetujuan')->nullable();
            $table->string('no_pa_adop')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
