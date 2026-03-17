<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FarmaciaConcepto;

class FarmaciaConceptoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $conceptos = ['ALMACEN ESTATAL','DONACION','DEVOLUCION CENTRO DE MEZCLAS','COMPRA INTERNA','INSABI','GASTOS CATASTROFICOS',];

        foreach ($conceptos as $concepto) {
            FarmaciaConcepto::create([
                'concepto' => $concepto,
                'tipo' => 1,
            ]);
        }
    }
}
