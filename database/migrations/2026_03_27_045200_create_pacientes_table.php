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
        Schema::create('pacientes', function (Blueprint $table) {
             $table->id();

            $table->string('curp', 18)->unique();
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno')->nullable();
            $table->date('fecha_nacimiento');
            $table->string('sexo', 10);
            $table->string('estado_civil')->nullable();
            $table->string('telefono', 20)->nullable();

            $table->string('residencia')->nullable();

            // Relaciones
            $table->foreignId('diagnostico_id')
                ->constrained('cat_tipos_de_cancer')
                ->cascadeOnDelete();

            $table->foreignId('cirujano_oncologo')
                ->constrained('medicos')
                ->cascadeOnDelete();

            $table->foreignId('oncologoi_medico')
                ->constrained('medicos')
                ->cascadeOnDelete();

            $table->foreignId('afiliacion_id')
                ->constrained('cat_afiliaciones')
                ->cascadeOnDelete();

            $table->boolean('primera_vez')->default(true);
            $table->text('alergias')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
