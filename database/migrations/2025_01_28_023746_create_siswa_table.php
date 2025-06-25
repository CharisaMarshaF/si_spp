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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id('nisn');
            $table->char('nis',8);
            $table->string('nama',35);
            $table->foreignId('id_kelas')->references('id')->on('kelas');
            $table->foreignId('id_spp')->references('id')->on('spp');
            $table->text('alamat');
            $table->string('no_telp',13);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
