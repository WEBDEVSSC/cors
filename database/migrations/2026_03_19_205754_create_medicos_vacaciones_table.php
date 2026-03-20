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
        Schema::create('medicos_vacaciones', function (Blueprint $table) {
            $table->id();

            // Relación con médicos
            $table->unsignedBigInteger('medico_id');

            // Fecha sin hora
            $table->date('fecha');

            // Foreign key
            $table->foreign('medico_id')
                ->references('id')
                ->on('medicos')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicos_vacaciones');
    }
};
