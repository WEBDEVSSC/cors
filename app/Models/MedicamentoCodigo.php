<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicamentoCodigo extends Model
{
        //
    protected $table = 'medicamentos_codigos'; // nombre exacto de la tabla

    protected $fillable = [
        'id_medicamento',
        'codigo',
        'forma_farmaceutica',
        'marca',
        'fabricante',
        'unidad_medida',
        'presentacion',
    ];

    // Relación: muchos códigos pertenecen a un medicamento
    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class, 'id_medicamento');
    }
}
