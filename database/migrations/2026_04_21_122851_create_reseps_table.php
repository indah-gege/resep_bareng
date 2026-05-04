<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reseps', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->text('deskripsi_singkat');
            $table->integer('waktu_masak'); 
            $table->integer('jumlah_porsi')->nullable(); // Dibuat aman
            $table->enum('tingkat_kesulitan', ['Mudah', 'Sedang', 'Sulit'])->nullable(); // Dibuat aman
            $table->json('bahan_bahan');
            $table->json('langkah_langkah');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reseps');
    }
};