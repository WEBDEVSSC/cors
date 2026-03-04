<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmaciaInventario extends Model
{
    //
    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'farmacia_inventario';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'clave_cabms',
        'medicamento',
        'codigo_barras',
        'cantidad',
        'fecha_caducidad',
        'concepto',
        'requisicion',
        'lote',
        'tipo',
    ];
}
