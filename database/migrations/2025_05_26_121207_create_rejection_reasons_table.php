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
        Schema::create('rejection_reasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('NIM_id');
            $table->foreign('NIM_id')->references('NIM')->on('users')->onDelete('cascade');
            $table->string('reason');
            $table->enum('file_type', ['rekomendasi', 'pernyataan', 'LoA', 'laporan_pertengahan', 'laporan_akhir', 'sertifikat', 'penilaian']);
            $table->enum('status', ['completed', 'rejected'])->default('rejected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rejection_reasons');
    }
};