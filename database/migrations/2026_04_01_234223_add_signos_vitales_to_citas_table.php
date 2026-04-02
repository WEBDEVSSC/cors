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
        Schema::table('citas', function (Blueprint $table) {
            //
            $table->decimal('peso', 5, 2)->nullable()->after('hora'); // kg (ej. 72.50)
            $table->decimal('talla', 4, 2)->nullable()->after('peso'); // metros (ej. 1.75)

            $table->unsignedSmallInteger('sistolica')->nullable()->after('talla'); // presión alta
            $table->unsignedSmallInteger('diastolica')->nullable()->after('sistolica'); // presión baja

            $table->unsignedSmallInteger('cardiaca')->nullable()->after('diastolica'); // FC (lpm)
            $table->unsignedSmallInteger('respiratoria')->nullable()->after('cardiaca'); // FR (rpm)

            $table->unsignedTinyInteger('temperatura')->nullable()->after('respiratoria'); // °C (ej. 36–40)
            $table->unsignedTinyInteger('saO2')->nullable()->after('temperatura'); // saturación (0–100)

            $table->unsignedTinyInteger('dolor')->nullable()->after('saO2'); // escala 0–10
            $table->boolean('caidas')->nullable()->after('dolor'); // sí/no
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citas', function (Blueprint $table) {
            //
            $table->dropColumn([
                'peso',
                'talla',
                'sistolica',
                'diastolica',
                'cardiaca',
                'respiratoria',
                'temperatura',
                'saO2',
                'dolor',
                'caidas'
            ]);
        });
    }
};
