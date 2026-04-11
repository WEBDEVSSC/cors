<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CitaSubsecuente extends Model
{
    //
    protected $table = 'citas_subsecuentes';

    // 🛡️ Campos asignables
    protected $fillable = [
        'cita_id',    
        'paciente_id',
        'evolucion',
        'estudios',
        'pronostico',
        'analisis',
        'id_medico',
    ];

    // 🔗 Relación con paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    // 🔗 Relación con cita
    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    // 🔗 Relación con médico
    public function medico()
    {
        return $this->belongsTo(Medico::class, 'id_medico');
    }

    public function getEdadPacienteAttribute()
    {
        if (!$this->paciente || !$this->paciente->fecha_nacimiento) {
            return null;
        }

        $fechaNacimiento = Carbon::parse($this->paciente->fecha_nacimiento);
        $fechaConsulta = Carbon::parse($this->created_at);

        return $fechaNacimiento->diff($fechaConsulta)->y;
    }
}
