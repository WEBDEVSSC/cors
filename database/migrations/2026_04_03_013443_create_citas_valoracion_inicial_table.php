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
        Schema::create('citas_valoracion_inicial', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->foreignId('paciente_id')
                  ->constrained('pacientes')
                  ->cascadeOnDelete();

            $table->foreignId('cita_id')
                  ->constrained('citas')
                  ->cascadeOnDelete();

            // Campos clínicos
            $table->text('padecimiento_actual')->nullable();
            $table->text('estudios_laboratorio')->nullable();
            $table->text('pronostico')->nullable();
            $table->text('analisis')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas_valoracion_inicial');
    }
};
