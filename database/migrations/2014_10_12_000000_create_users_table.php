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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('NIK')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'mahasiswa', 'dosen']);

            $table->enum('status', ['none', 'surat_rekomendasi', 'surat_PTJM', 'LoA', 'laporan_pertengahan', 'laporan_akhir', 'sertifikat_penilaian'])->default('none');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
