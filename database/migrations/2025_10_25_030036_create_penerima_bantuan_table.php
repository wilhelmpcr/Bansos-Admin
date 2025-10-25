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
         Schema::create('penerima_bantuan', function (Blueprint $table) {
        $table->id('penerima_id');
        $table->unsignedBigInteger('program_id');
        $table->unsignedBigInteger('warga_id');
        $table->string('keterangan')->nullable();
        $table->timestamps();

        $table->foreign('program_id')->references('program_id')->on('program_bantuan')->onDelete('cascade');
        $table->foreign('warga_id')->references('warga_id')->on('warga')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerima_bantuan');
    }
};
