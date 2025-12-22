<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('verifikasi_lapangan', function (Blueprint $table) {
            $table->id('verifikasi_id');

            // FK HARUS MANUAL ke pendaftar_id
            $table->unsignedBigInteger('pendaftar_id');

            $table->foreign('pendaftar_id')
                  ->references('pendaftar_id')
                  ->on('pendaftar_bantuan')
                  ->cascadeOnDelete();

            $table->string('petugas', 100);
            $table->date('tanggal');
            $table->text('catatan')->nullable();
            $table->decimal('skor', 5, 2)->nullable();
            $table->json('foto_verifikasi')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('tanggal');
            $table->index('petugas');
            $table->index('skor');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verifikasi_lapangan');
    }
};
