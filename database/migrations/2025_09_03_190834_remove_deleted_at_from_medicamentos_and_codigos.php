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
        Schema::table('medicamentos', function (Blueprint $table) {
            if (Schema::hasColumn('medicamentos', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        // Eliminar columna deleted_at de medicamentos_codigos
        Schema::table('medicamentos_codigos', function (Blueprint $table) {
            if (Schema::hasColumn('medicamentos_codigos', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Volver a crear la columna deleted_at en caso de rollback
        Schema::table('medicamentos', function (Blueprint $table) {
            $table->softDeletes(); // Esto crea deleted_at
        });

        Schema::table('medicamentos_codigos', function (Blueprint $table) {
            $table->softDeletes(); // Esto crea deleted_at
        });
    }
};
