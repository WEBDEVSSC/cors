<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatAfiliacion extends Model
{
    //
    protected $table = 'cat_afiliaciones';

    protected $fillable = [
        'afiliacion'
    ];

    /**
     * Relación: una afiliación tiene muchos pacientes
     */
    public function pacientes()
    {
        //return $this->hasMany(Paciente::class, 'afiliacion_id');
    }
}
