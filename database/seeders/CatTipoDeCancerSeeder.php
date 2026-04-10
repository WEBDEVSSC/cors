<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CatTipoDeCancer;
use Illuminate\Support\Facades\DB;

class CatTipoDeCancerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('cat_tipos_de_cancer')->truncate();

        CatTipoDeCancer::insert([
            ['id' => 1, 'nombre' => 'ADENOCARCINOMA GLEASON'],
            ['id' => 2, 'nombre' => 'CÁNCER DE MAMA'],
            ['id' => 3, 'nombre' => 'CÁNCER GÁSTRICO'],
            ['id' => 4, 'nombre' => 'CÁNCER DE OVARIO'],
            ['id' => 5, 'nombre' => 'CÁNCER RENAL'],
            ['id' => 6, 'nombre' => 'LEIOSARCOMA'],
            ['id' => 7, 'nombre' => 'LINFOma NO HODGKIN'],
            ['id' => 8, 'nombre' => 'L. L. C.'],
            ['id' => 9, 'nombre' => 'CÁNCER DE COLON'],
            ['id' => 10, 'nombre' => 'CÁNCER DE PULMÓN'],
            ['id' => 11, 'nombre' => 'MELANOMA'],
            ['id' => 12, 'nombre' => 'CÁNCER DE LARINGE'],
            ['id' => 13, 'nombre' => 'TUMOR ANEXIAL'],
            ['id' => 14, 'nombre' => 'CÁNCER DE PRÓSTATA'],
            ['id' => 15, 'nombre' => 'CÁNCER DE ENDOMETRIO'],
            ['id' => 16, 'nombre' => 'TUMOR GERMINAL'],
            ['id' => 17, 'nombre' => 'CÁNCER CERVICOUTERINO'],
            ['id' => 18, 'nombre' => 'HEPATOCARCINOMA'],
            ['id' => 19, 'nombre' => 'SIN DX ONCOLÓGICO'],
            ['id' => 20, 'nombre' => 'SARCOMA DE KAPOSI'],
            ['id' => 21, 'nombre' => 'MIELOMA'],
            ['id' => 22, 'nombre' => 'CÁNCER DE RECTO'],
            ['id' => 23, 'nombre' => 'CÁNCER DE PIEL'],
            ['id' => 24, 'nombre' => 'CÁNCER DE TESTÍCULO'],
            ['id' => 25, 'nombre' => 'HEPATOCARCINOMA'],
            ['id' => 26, 'nombre' => 'CÁNCER DE VEJIGA'],
            ['id' => 27, 'nombre' => 'CÁNCER UROTELIAL'],
            ['id' => 28, 'nombre' => 'CÁNCER DE TIROIDES'],
            ['id' => 29, 'nombre' => 'CÁNCER DE PÁNCREAS'],
            ['id' => 30, 'nombre' => 'CÁNCER ENDOMETRIO'],
            ['id' => 31, 'nombre' => 'OSTEOSARCOMA'],
            ['id' => 32, 'nombre' => 'CÁNCER DE PENE'],
            ['id' => 33, 'nombre' => 'LINFOMA DE HODGKIN'],
            ['id' => 34, 'nombre' => 'LIPOSARCOMA'],
            ['id' => 35, 'nombre' => 'SARCOMA ALVEOLAR'],
            ['id' => 36, 'nombre' => 'SARCOMA ALVEOLAR'],
            ['id' => 37, 'nombre' => 'AMAYA NARRO ELODIA'],
            ['id' => 38, 'nombre' => 'CIRROSIS HEPÁTICA'],
            ['id' => 39, 'nombre' => '38'],
            ['id' => 40, 'nombre' => 'CIRROSIS HEPÁTICA'],
            ['id' => 41, 'nombre' => 'CÁNCER DE TIROIDES'],
            ['id' => 42, 'nombre' => 'NÓDULO MAMARIO'],
            ['id' => 43, 'nombre' => 'METAPLASIA APOCRINA'],
            ['id' => 44, 'nombre' => 'CÁNCER DUODENAL'],
            ['id' => 45, 'nombre' => 'ADENOCARCINOMA METASTÁSICO'],
            ['id' => 46, 'nombre' => 'SARCOMA INDIFERENCIADO'],
            ['id' => 47, 'nombre' => 'ADENOMA PARATIROIDEO'],
            ['id' => 48, 'nombre' => 'ADENOMA PARATIROIDEO'],
            ['id' => 49, 'nombre' => 'SARCOMA MEDIASTINAL'],
            ['id' => 50, 'nombre' => 'CÁNCER DE ESÓFAGO'],
            ['id' => 51, 'nombre' => 'CARCINOMA EPIDERMOIDES'],
            ['id' => 52, 'nombre' => 'CARCINOMA BASOCELULAR'],
            ['id' => 53, 'nombre' => 'TUMOR DE KRUKENBERG'],
            ['id' => 54, 'nombre' => 'NEOPLASIA MALIGNA DE ESTIRPE MESENQUIMAL'],
            ['id' => 55, 'nombre' => 'CARCINOMA RENAL'],
            ['id' => 56, 'nombre' => 'HEMOFILIA'],
            ['id' => 57, 'nombre' => 'CÁNCER DE LENGUA'],
            ['id' => 58, 'nombre' => 'TUMOR OCCIPITAL'],
            ['id' => 59, 'nombre' => 'CARCINOMA EPIDERMOIDES'],
            ['id' => 60, 'nombre' => 'CÁNCER PARÓTIDA'],
            ['id' => 61, 'nombre' => 'CÁNCER DE TIROIDES'],
            ['id' => 62, 'nombre' => 'NEOPLASIA POCO DIFERENCIADA'],
            ['id' => 63, 'nombre' => 'ADENOCARCINOMA INTESTINAL'],
            ['id' => 64, 'nombre' => 'ESPIROADENOMA ECRINO MALIGNO'],
            ['id' => 65, 'nombre' => 'HIPERPLASIA'],
            ['id' => 66, 'nombre' => 'TUMOR NEUROENDOCRINO'],
            ['id' => 67, 'nombre' => 'ASTROCITOMA DIFUSO GRADO II'],
            ['id' => 68, 'nombre' => 'LINFOMA DIFUSO DE CÉLULAS GRANDES B'],
            ['id' => 69, 'nombre' => 'NEOPLASIA FOLICULAR'],
            ['id' => 70, 'nombre' => 'CÁNCER DE CUELLO'],
            ['id' => 71, 'nombre' => 'SARCOMA RETROPERITONEAL'],
            ['id' => 72, 'nombre' => 'CÁNCER DE VULVA'],
            ['id' => 73, 'nombre' => 'CARCINOMA DUCTAL INFILTRANTE'],
            ['id' => 74, 'nombre' => 'HIPERPLASIA ENDOMETRIAL ATÍPICA'],
            ['id' => 75, 'nombre' => 'CARCINOMA POCO DIFERENCIADO'],
            ['id' => 76, 'nombre' => 'OSTEOSARCOMA'],
            ['id' => 77, 'nombre' => 'TUMOR MIXTO MÜLLERIANO'],
            ['id' => 78, 'nombre' => 'TUMOR DESMOIDE'],
            ['id' => 79, 'nombre' => 'OLIGODENDROGLIOMA ANAPLÁSICO'],
            ['id' => 80, 'nombre' => 'L. L. A.'],
            ['id' => 81, 'nombre' => 'ADENOMA TÚBULO VELLOSO'],
            ['id' => 82, 'nombre' => 'HISTIOCITOSIS GANGLIONAR'],
            ['id' => 83, 'nombre' => 'TUMOR PHYLLODES'],
            ['id' => 84, 'nombre' => 'ASTROCITOMA ANAPLÁSICO'],
            ['id' => 85, 'nombre' => 'LEUCEMIA MIELOIDE AGUDA'],
            ['id' => 86, 'nombre' => 'CÁNCER DE CÉRVIX'],
            ['id' => 87, 'nombre' => 'TROMBOCITOPENIA'],
            ['id' => 88, 'nombre' => 'ADENOCARCINOMA DE COLÉDOCO'],
            ['id' => 89, 'nombre' => 'FIBROMATOSIS DESMOIDE'],
            ['id' => 90, 'nombre' => 'NEOPLASIA DE CÉLULAS DIFERENCIADAS'],
            ['id' => 91, 'nombre' => 'ADENOCARCINOMA DE CUELLO'],
        ]);
    }
}
