<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmaciaConcepto extends Model
{
    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'farmacia_conceptos';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'concepto',
        'tipo',
    ];
}
