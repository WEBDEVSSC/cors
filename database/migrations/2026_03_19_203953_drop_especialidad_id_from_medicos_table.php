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
        Schema::table('medicos', function (Blueprint $table) {
            //
            // Si tiene foreign key, primero elimínala
            $table->dropForeign(['especialidad_id']);

            // Luego elimina la columna
            $table->dropColumn('especialidad_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medicos', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('especialidad_id')->nullable();

            $table->foreign('especialidad_id')
                ->references('id')
                ->on('cat_especialidad_medicas')
                ->onDelete('cascade');
        });
    }
};
