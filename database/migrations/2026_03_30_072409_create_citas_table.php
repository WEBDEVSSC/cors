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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();

            // 🔗 Relaciones (forma moderna Laravel)
            $table->foreignId('paciente_id')
                ->constrained('pacientes')
                ->cascadeOnDelete();

            $table->foreignId('medico_id')
                ->constrained('medicos')
                ->cascadeOnDelete();

            // 📅 Fecha y hora
            $table->date('fecha');
            $table->time('hora');

            $table->timestamps();

            // 🚫 Evitar citas duplicadas
            $table->unique(['medico_id', 'fecha', 'hora']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
