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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('NIK_id');
            $table->foreign('NIK_id')->references('NIK')->on('users')->onDelete('cascade');
            $table->foreignId('data_mbkm_id')->constrained('data_mbkm')->onDelete('cascade');
            $table->string('laporan_pertengahan');
            $table->enum('status_laporan_pertengahan', ['pending', 'submited', 'approve'])->default('pending');
            $table->string('laporan_akhir');
            $table->enum('status_laporan_akhir', ['pending', 'submited', 'approve'])->default('pending');
            $table->string('sertifikat');
            $table->string('penilaian');
            $table->enum('status_sertifikat_penilaian', ['pending', 'submited', 'approve'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};