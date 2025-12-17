<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {Schema::create('pendaftar_bantuan', function (Blueprint $table) {
    $table->id('pendaftar_id');
    $table->unsignedBigInteger('warga_id');
    $table->unsignedBigInteger('program_id');
    $table->enum('status_seleksi', ['pending', 'diterima', 'ditolak'])
          ->default('pending');
    $table->timestamps();

    $table->foreign('warga_id')
          ->references('warga_id')
          ->on('warga')
          ->cascadeOnDelete();

    $table->foreign('program_id')
          ->references('program_id')
          ->on('program_bantuan')
          ->cascadeOnDelete();
});
}

    public function down(): void
    {
        Schema::dropIfExists('pendaftar_bantuan');
    }
};
