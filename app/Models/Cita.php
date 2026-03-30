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
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'datetime:H:i',
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
