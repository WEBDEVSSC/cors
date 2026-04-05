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
        Schema::table('citas_valoracion_inicial', function (Blueprint $table) {
            //
            // 🔗 Tipo de cáncer
            $table->foreignId('tipo_cancer_id')
                  ->nullable()
                  ->after('id') // ajusta la posición si quieres
                  ->constrained('cat_tipos_de_cancer')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();

            // 🔗 Diagnóstico CIE-10
            $table->foreignId('id_diagnostico_cie10')
                  ->nullable()
                  ->after('tipo_cancer_id')
                  ->constrained('cat_cie10') // 👈 ajusta si tu tabla es cat_cie_10
                  ->cascadeOnUpdate()
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citas_valoracion_inicial', function (Blueprint $table) {
            //
            $table->dropForeign(['tipo_cancer_id']);
            $table->dropColumn('tipo_cancer_id');

            $table->dropForeign(['id_diagnostico_cie10']);
            $table->dropColumn('id_diagnostico_cie10');
        });
    }
};
