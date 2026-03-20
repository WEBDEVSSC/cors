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
            $table->renameColumn('especialidad', 'especialidad_id');

            $table->foreign('especialidad_id')
                ->references('id')
                ->on('cat_especialidades_medicas')
                ->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medicos', function (Blueprint $table) {
            //
            $table->renameColumn('especialidad_id', 'especialidad');
        });
    }
};
