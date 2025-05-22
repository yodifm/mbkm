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
        Schema::create('data_mbkm', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('NIM_id');
            $table->foreign('NIM_id')->references('NIM')->on('users')->onDelete('cascade');

            $table->foreignId('pemberkasan_id')->constrained('pemberkasan')->onDelete('cascade');
            $table->string('program_mbkm');
            $table->string('mitra_mbkm');
            $table->string('posisi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->string('LoA');
            $table->enum('status_LoA', ['submited', 'approved', 'rejected'])->default('submited');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datambkm');
    }
};