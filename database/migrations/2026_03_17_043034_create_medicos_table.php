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
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();

            // Datos personales
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno')->nullable();

            // Datos profesionales
            $table->string('cedula')->unique();
            $table->string('rubrica')->nullable(); // firma o archivo

            // Contacto
            $table->string('correo')->unique();
            $table->string('celular')->nullable();

            // Especialidad
            $table->string('especialidad');

            // Horarios
            $table->time('lunes_entrada')->nullable();
            $table->time('lunes_salida')->nullable();

            $table->time('martes_entrada')->nullable();
            $table->time('martes_salida')->nullable();

            $table->time('miercoles_entrada')->nullable();
            $table->time('miercoles_salida')->nullable();

            $table->time('jueves_entrada')->nullable();
            $table->time('jueves_salida')->nullable();

            $table->time('viernes_entrada')->nullable();
            $table->time('viernes_salida')->nullable();

            // Estado
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};
