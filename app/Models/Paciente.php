<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    //
    protected $table = 'pacientes';

    protected $fillable = [
        'curp',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'sexo',
        'estado_civil',
        'telefono',
        'residencia',
        'diagnostico_id',
        'cirujano_oncologo',
        'oncologo_medico',
        'afiliacion_id',
        'primera_vez',
        'alergias',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'primera_vez' => 'boolean',
    ];

    // Tipo de cáncer
    public function diagnostico()
    {
        return $this->belongsTo(CatTipoDeCancer::class, 'diagnostico_id');
    }

    // Cirujano oncólogo
    public function cirujano()
    {
        return $this->belongsTo(Medico::class, 'cirujano_oncologo');
    }

    // Oncólogo médico
    public function oncologo()
    {
        return $this->belongsTo(Medico::class, 'oncologo_medico');
    }

    // Afiliación
    public function afiliacion()
    {
        return $this->belongsTo(CatAfiliacion::class, 'afiliacion_id');
    }

    /**
     * Accesor (nombre completo)
     */
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}";
    }

}
