<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatEspecialidadMedica extends Model
{
    //
    protected $table = 'cat_especialidades_medicas';

    protected $fillable = [
        'especialidad'
    ];

    /**
     * Relación: una especialidad tiene muchos médicos
     */
    public function medicos()
    {
        return $this->hasMany(Medico::class, 'especialidad_id');
    }
}
