<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicamento extends Model
{    
    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'medicamentos';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'clave',
        'nombre',
    ];

    // Relación: un medicamento puede tener muchos códigos
    public function codigos()
    {
        return $this->hasMany(MedicamentoCodigo::class, 'id_medicamento');
    }

    protected static function booted()
    {
        static::deleting(function ($medicamento) {
            $medicamento->codigos()->delete();
        });
    }
}
