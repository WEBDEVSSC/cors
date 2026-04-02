<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    //
    protected $table = 'citas';

    // 🛡️ Campos asignables
    protected $fillable = [
        'paciente_id',
        'medico_id',
        'fecha',
        'hora',
        'peso',
        'talla',
        'sistolica',
        'diastolica',
        'cardiaca',
        'respiratoria',
        'temperatura',
        'saO2',
        'dolor',
        'caidas',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'datetime:H:i',
        'peso' => 'decimal:2',
        'talla' => 'decimal:2',
        'sistolica' => 'integer',
        'diastolica' => 'integer',
        'cardiaca' => 'integer',
        'respiratoria' => 'integer',
        'temperatura' => 'decimal:1',
        'saO2' => 'integer',
        'dolor' => 'integer',
        'caidas' => 'boolean',
    ];

    public function getFechaFormateadaAttribute()
    {
        return $this->fecha->format('d/m/Y');
    }

    public function getHoraFormateadaAttribute()
    {
        return \Carbon\Carbon::parse($this->hora)->format('H:i');
    }

    // 🔗 Relación con paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    // 🔗 Relación con médico
    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }
}
