<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_penyaluran', function (Blueprint $table) {
            $table->id('penyaluran_id');
            $table->unsignedBigInteger('pendaftar_id');
            $table->unsignedBigInteger('verifikasi_id')->nullable();
            $table->date('tanggal');
            $table->decimal('jumlah', 15, 2);
            $table->text('keterangan')->nullable();
            $table->enum('status', ['draft', 'diproses', 'selesai', 'dibatalkan'])
                ->default('selesai');
            $table->json('dokumen')->nullable();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_penyaluran');
    }
};
