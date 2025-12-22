<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penerima_bantuan', function (Blueprint $table) {
            $table->id('penerima_id');

            // Kolom data penerima
            $table->string('nama');
            $table->string('nik', 16)->unique();
            $table->string('alamat')->nullable();
            $table->date('tanggal_daftar')->nullable();

            // Relasi
            $table->foreignId('warga_id')
                ->nullable()
                ->constrained('warga', 'warga_id')
                ->cascadeOnDelete();

            $table->foreignId('program_id')
                ->constrained('program_bantuan', 'program_id')
                ->cascadeOnDelete();

            // Kolom tambahan
            $table->text('keterangan')->nullable();
            $table->string('status')->default('menunggu');

            // ✅ TAMBAHAN FOTO (INI YANG KURANG)
            $table->string('foto')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penerima_bantuan');
    }
};
