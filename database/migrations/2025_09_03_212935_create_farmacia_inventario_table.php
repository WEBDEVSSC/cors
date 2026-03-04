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
        Schema::create('farmacia_inventarios', function (Blueprint $table) {
            $table->id();
            $table->string('clave_cabms');
            $table->string('medicamento');
            $table->string('codigo_barras');
            $table->integer('cantidad');
            $table->date('fecha_caducidad');
            $table->string('concepto');
            $table->string('requisicion');
            $table->string('lote');
            $table->integer('tipo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmacia_inventario');
    }
};
