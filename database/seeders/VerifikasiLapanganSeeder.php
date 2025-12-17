<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('verifikasi_lapangan', function (Blueprint $table) {
            $table->id('verifikasi_id');
            $table->string('petugas');
            $table->date('tanggal');
            $table->text('catatan')->nullable();
            $table->decimal('skor', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verifikasi_lapangan');
    }
};
