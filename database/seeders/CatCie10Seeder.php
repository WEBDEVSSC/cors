<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatCie10Seeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['codigo' => 'C00', 'descripcion' => 'Neoplasia maligna del labio'],
            ['codigo' => 'C01', 'descripcion' => 'Neoplasia maligna de la base de la lengua'],
            ['codigo' => 'C02', 'descripcion' => 'Neoplasia maligna de otras partes de la lengua'],
            ['codigo' => 'C03', 'descripcion' => 'Neoplasia maligna de la encía'],
            ['codigo' => 'C04', 'descripcion' => 'Neoplasia maligna del suelo de la boca'],
            ['codigo' => 'C05', 'descripcion' => 'Neoplasia maligna del paladar'],
            ['codigo' => 'C06', 'descripcion' => 'Neoplasia maligna de otras partes de la boca'],
            ['codigo' => 'C07', 'descripcion' => 'Neoplasia maligna de la glándula parótida'],
            ['codigo' => 'C08', 'descripcion' => 'Neoplasia maligna de otras glándulas salivales mayores'],
            ['codigo' => 'C09', 'descripcion' => 'Neoplasia maligna de la amígdala'],
            ['codigo' => 'C10', 'descripcion' => 'Neoplasia maligna de la orofaringe'],
            ['codigo' => 'C11', 'descripcion' => 'Neoplasia maligna de la nasofaringe'],
            ['codigo' => 'C12', 'descripcion' => 'Neoplasia maligna del seno piriforme'],
            ['codigo' => 'C13', 'descripcion' => 'Neoplasia maligna de la hipofaringe'],
            ['codigo' => 'C14', 'descripcion' => 'Neoplasia maligna de otros sitios del labio, cavidad oral y faringe'],
            ['codigo' => 'C15', 'descripcion' => 'Neoplasia maligna del esófago'],
            ['codigo' => 'C16', 'descripcion' => 'Neoplasia maligna del estómago'],
            ['codigo' => 'C18', 'descripcion' => 'Neoplasia maligna del colon'],
            ['codigo' => 'C19', 'descripcion' => 'Neoplasia maligna de la unión rectosigmoidea'],
            ['codigo' => 'C20', 'descripcion' => 'Neoplasia maligna del recto'],
            ['codigo' => 'C22', 'descripcion' => 'Neoplasia maligna del hígado y vías biliares intrahepáticas'],
            ['codigo' => 'C23', 'descripcion' => 'Neoplasia maligna de la vesícula biliar'],
            ['codigo' => 'C25', 'descripcion' => 'Neoplasia maligna del páncreas'],
            ['codigo' => 'C32', 'descripcion' => 'Neoplasia maligna de la laringe'],
            ['codigo' => 'C33', 'descripcion' => 'Neoplasia maligna de la tráquea'],
            ['codigo' => 'C34', 'descripcion' => 'Neoplasia maligna de los bronquios y del pulmón'],
            ['codigo' => 'C43', 'descripcion' => 'Melanoma maligno de la piel'],
            ['codigo' => 'C44', 'descripcion' => 'Otras neoplasias malignas de la piel'],
            ['codigo' => 'C50', 'descripcion' => 'Neoplasia maligna de la mama'],
            ['codigo' => 'C53', 'descripcion' => 'Neoplasia maligna del cuello del útero'],
            ['codigo' => 'C54', 'descripcion' => 'Neoplasia maligna del cuerpo del útero'],
            ['codigo' => 'C56', 'descripcion' => 'Neoplasia maligna del ovario'],
            ['codigo' => 'C61', 'descripcion' => 'Neoplasia maligna de la próstata'],
            ['codigo' => 'C62', 'descripcion' => 'Neoplasia maligna del testículo'],
            ['codigo' => 'C64', 'descripcion' => 'Neoplasia maligna del riñón'],
            ['codigo' => 'C67', 'descripcion' => 'Neoplasia maligna de la vejiga urinaria'],
            ['codigo' => 'C71', 'descripcion' => 'Neoplasia maligna del encéfalo'],
            ['codigo' => 'C73', 'descripcion' => 'Neoplasia maligna de la glándula tiroides'],
            ['codigo' => 'C81', 'descripcion' => 'Linfoma de Hodgkin'],
            ['codigo' => 'C85', 'descripcion' => 'Otros linfomas no Hodgkin'],
            ['codigo' => 'C90', 'descripcion' => 'Mieloma múltiple'],
            ['codigo' => 'C91', 'descripcion' => 'Leucemia linfoide'],
            ['codigo' => 'C92', 'descripcion' => 'Leucemia mieloide'],
        ];

        DB::table('cat_cie10')->insert($data);
    }
}