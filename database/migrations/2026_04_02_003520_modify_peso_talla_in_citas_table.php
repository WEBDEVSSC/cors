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
        Schema::table('citas', function (Blueprint $table) {
            // Peso con 3 decimales (ej: 68.530)
            $table->decimal('peso', 6, 3)->nullable()->change();

            // Talla en cm (ej: 173)
            $table->unsignedSmallInteger('talla')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citas', function (Blueprint $table) {
            //
            $table->decimal('peso', 5, 2)->nullable()->change();
            $table->decimal('talla', 4, 2)->nullable()->change();
        });
    }
};
