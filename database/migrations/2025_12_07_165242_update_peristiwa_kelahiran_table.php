<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peristiwa_kelahiran', function (Blueprint $table) {
            $table->id('kelahiran_id');
            $table->string('nama_bayi');
            $table->unsignedBigInteger('anak_warga_id');
            $table->unsignedBigInteger('ayah_warga_id');
            $table->unsignedBigInteger('ibu_warga_id');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peristiwa_kelahiran');
    }
};
