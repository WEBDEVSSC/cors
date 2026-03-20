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
        Schema::table('medicos_vacaciones', function (Blueprint $table) {
            //
            $table->string('concepto', 255)->after('fecha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medicos_vacaciones', function (Blueprint $table) {
            //
            $table->dropColumn('concepto');
        });
    }
};
