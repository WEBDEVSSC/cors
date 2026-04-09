<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medicos', function (Blueprint $table) {
            $table->unsignedBigInteger('especialidad')->change();

            $table->foreign('especialidad')
                ->references('id')
                ->on('cat_especialidades_medicas')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('medicos', function (Blueprint $table) {
            $table->dropForeign(['especialidad']);
            $table->string('especialidad')->change();
        });
    }
};