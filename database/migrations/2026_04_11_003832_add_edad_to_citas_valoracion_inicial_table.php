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
        Schema::table('citas_valoracion_inicial', function (Blueprint $table) {
            //
            $table->integer('edad')
                  ->nullable()
                  ->after('id_medico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citas_valoracion_inicial', function (Blueprint $table) {
            //
            $table->dropColumn('edad');
        });
    }
};
