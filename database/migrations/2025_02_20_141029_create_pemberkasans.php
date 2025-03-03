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
        Schema::create('pemberkasans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('NIK_id'); // Ensure it's unsigned
        
            // Ensure 'NIK' in 'users' is a primary/unique and unsigned field
            $table->foreign('NIK_id')->references('NIK')->on('users')->onDelete('cascade');
        
            $table->integer('semester');
            $table->string('dosen_pembimbing');
            $table->string('surat_rekomendasi')->nullable();
            $table->string('surat_pernyataan')->nullable();
            
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::dropIfExists('pemberkasans');
    }
};
