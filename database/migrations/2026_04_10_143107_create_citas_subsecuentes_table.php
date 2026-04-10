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
        Schema::create('citas_subsecuentes', function (Blueprint $table) {
            $table->id();

            // Relación con citas
            $table->foreignId('cita_id')
                  ->constrained('citas')
                  ->onDelete('cascade');

            // Campos de texto (nullable)
            $table->text('evolucion')->nullable();
            $table->text('estudios')->nullable();
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
        Schema::dropIfExists('citas_subsecuentes');
    }
};
