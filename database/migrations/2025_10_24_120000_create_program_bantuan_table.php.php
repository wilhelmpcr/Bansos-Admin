<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_bantuan', function (Blueprint $table) {
            $table->id('program_id'); // Primary key
            $table->string('kode', 50)->unique(); // Kode program
            $table->string('nama_program'); // Nama program
            $table->text('deskripsi')->nullable(); // Deskripsi program
            $table->integer('tahun'); // Tahun program
            $table->decimal('anggaran', 15, 2)->default(0); // Anggaran program
            $table->string('status')->default('aktif'); // Status program: aktif / nonaktif
            $table->string('foto')->nullable(); // Foto program
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_bantuan');
    }
};
