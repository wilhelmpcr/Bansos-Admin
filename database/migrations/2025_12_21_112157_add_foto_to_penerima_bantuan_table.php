<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penerima_bantuan', function (Blueprint $table) {
            if (!Schema::hasColumn('penerima_bantuan', 'foto')) {
                $table->string('foto')->nullable()->after('keterangan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('penerima_bantuan', function (Blueprint $table) {
            if (Schema::hasColumn('penerima_bantuan', 'foto')) {
                $table->dropColumn('foto');
            }
        });
    }
};
