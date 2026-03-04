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
        Schema::create('medicamentos_codigos', function (Blueprint $table) {
            $table->id();

            // Clave foránea hacia medicamentos
            $table->unsignedBigInteger('id_medicamento');
            $table->string('codigo');

            $table->foreign('id_medicamento')
                  ->references('id')
                  ->on('medicamentos')
                  ->onDelete('cascade'); // si se borra el medicamento, borra también sus códigos

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamentos_codigos');
    }
};
