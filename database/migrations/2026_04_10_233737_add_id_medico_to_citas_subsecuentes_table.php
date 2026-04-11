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
        Schema::table('citas_subsecuentes', function (Blueprint $table) {
            //
            $table->foreignId('id_medico')
                  ->after('paciente_id')
                  ->constrained('medicos')
                  ->cascadeOnDelete(); // o ->nullOnDelete()
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citas_subsecuentes', function (Blueprint $table) {
            //
            $table->dropForeign(['id_medico']);
            $table->dropColumn('id_medico');
        });
    }
};
