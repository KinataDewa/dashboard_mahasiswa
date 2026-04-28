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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();

            // relasi ke mahasiswa
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // relasi ke mata kuliah
            $table->foreignId('mata_kuliah_id')->constrained()->onDelete('cascade');

            // data absensi
            $table->date('tanggal');
            $table->enum('status', ['hadir', 'izin', 'alpha']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
