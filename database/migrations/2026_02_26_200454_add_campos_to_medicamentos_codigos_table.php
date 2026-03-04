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
        Schema::table('medicamentos_codigos', function (Blueprint $table) {
            //

            $table->text('forma_farmaceutica')
                  ->nullable()
                  ->after('codigo');

            $table->text('marca')
                  ->nullable()
                  ->after('forma_farmaceutica');

            $table->text('fabricante')
                  ->nullable()
                  ->after('marca');

            $table->text('unidad_medida')
                  ->nullable()
                  ->after('fabricante');

            $table->text('presentacion')
                  ->nullable()
                  ->after('unidad_medida');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medicamentos_codigos', function (Blueprint $table) {
            //
            $table->dropColumn([
                'forma_farmaceutica',
                'marca',
                'fabricante',
                'unidad_medida',
                'presentacion'
            ]);
        });
    }
};
