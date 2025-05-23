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
            $table->unsignedBigInteger('NIM_id');
            $table->foreign('NIM_id')->references('NIM')->on('users')->onDelete('cascade');
            $table->foreignId('data_mbkm_id')->constrained('data_mbkm')->onDelete('cascade');
            $table->string('laporan_pertengahan')->nullable();
            $table->enum('status_laporan_pertengahan', ['pending', 'submited', 'approved', 'rejected'])->default('pending');
            $table->string('laporan_akhir')->nullable();
            $table->enum('status_laporan_akhir', ['pending', 'submited', 'approved', 'rejected'])->default('pending');
            $table->string('sertifikat')->nullable();
            $table->enum('status_sertifikat', ['pending', 'submited', 'approved', 'rejected'])->default('pending');
            $table->string('penilaian')->nullable();
            $table->enum('status_penilaian', ['pending', 'submited', 'approved', 'rejected'])->default('pending');
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