<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id');

            // relasi ke warga (aman)
            $table->foreignId('warga_id')
                  ->nullable()
                  ->constrained('warga', 'warga_id')
                  ->cascadeOnDelete();

            // relasi fleksibel (verifikasi, dll)
            $table->unsignedBigInteger('ref_id')->nullable();

            // kolom yang mau kamu tambahkan
            $table->string('file_url')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('media');
    }
};
