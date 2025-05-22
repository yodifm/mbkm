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
        Schema::create('pemberkasan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('NIM_id');

            $table->foreign('NIM_id')->references('NIM')->on('users')->onDelete('cascade');

            $table->string('semester');
            $table->string('angkatan');
            $table->string('dosen_pembimbing');
            $table->string('surat_rekomendasi')->nullable();
            $table->enum('status_surat_rekomendasi', ['submited', 'approved', 'rejected'])->default('submited');

            $table->string('surat_pernyataan')->nullable();
            $table->enum('status_surat_pernyataan', ['submited', 'approved', 'rejected'])->default('submited');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('pemberkasan');
    }
};