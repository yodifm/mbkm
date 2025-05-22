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
            $table->string('laporan_pertengahan');
            $table->enum('status_laporan_pertengahan', ['submited', 'approved', 'rejected'])->default('submited');
            $table->string('laporan_akhir');
            $table->enum('status_laporan_akhir', ['submited', 'approved', 'rejected'])->default('submited');
            $table->string('sertifikat');
            $table->enum('status_sertifikat', ['submited', 'approved', 'rejected'])->default('submited');
            $table->string('penilaian');
            $table->enum('status_penilaian', ['submited', 'approved', 'rejected'])->default('submited');
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