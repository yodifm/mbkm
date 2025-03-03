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
        Schema::create('datambkms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('NIK_id'); // Ensure it's unsigned
        
            // Ensure 'NIK' in 'users' is a primary/unique and unsigned field
            $table->foreign('NIK_id')->references('NIK')->on('users')->onDelete('cascade');

            $table->foreignId('pemberkasans_id')->constrained('pemberkasans')->onDelete('cascade');
            $table->string('program_mbkm');
            $table->string('mitra_mbkm');
            $table->string('posisi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->string('LoA');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datambkms');
    }
};
