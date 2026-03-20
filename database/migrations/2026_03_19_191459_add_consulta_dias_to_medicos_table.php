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
        Schema::table('medicos', function (Blueprint $table) {
            //
            $table->unsignedTinyInteger('lunes_consulta')
                ->default(0)
                ->after('lunes_salida');

            $table->unsignedTinyInteger('martes_consulta')
                ->default(0)
                ->after('martes_salida');

            $table->unsignedTinyInteger('miercoles_consulta')
                ->default(0)
                ->after('miercoles_salida');

            $table->unsignedTinyInteger('jueves_consulta')
                ->default(0)
                ->after('jueves_salida');

            $table->unsignedTinyInteger('viernes_consulta')
                ->default(0)
                ->after('viernes_salida');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medicos', function (Blueprint $table) {
            //
            $table->dropColumn([
                'lunes_consulta',
                'martes_consulta',
                'miercoles_consulta',
                'jueves_consulta',
                'viernes_consulta'
            ]);
        });
    }
};
