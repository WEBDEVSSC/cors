<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    //

    protected $table = 'medicos';

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'cedula',
        'rubrica',
        'correo',
        'celular',
        'especialidad_id',
        'lunes_entrada',
        'lunes_salida',
        'martes_entrada',
        'martes_salida',
        'miercoles_entrada',
        'miercoles_salida',
        'jueves_entrada',
        'jueves_salida',
        'viernes_entrada',
        'viernes_salida',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'lunes_entrada' => 'datetime:H:i',
        'lunes_salida' => 'datetime:H:i',
        'martes_entrada' => 'datetime:H:i',
        'martes_salida' => 'datetime:H:i',
        'miercoles_entrada' => 'datetime:H:i',
        'miercoles_salida' => 'datetime:H:i',
        'jueves_entrada' => 'datetime:H:i',
        'jueves_salida' => 'datetime:H:i',
        'viernes_entrada' => 'datetime:H:i',
        'viernes_salida' => 'datetime:H:i',
    ];

    public function especialidad()
    {
        return $this->belongsTo(CatEspecialidadMedica::class, 'especialidad_id');
    }

    public function vacaciones()
    {
        return $this->hasMany(MedicoVacacion::class);
    }

    /**
     * Accesor para nombre completo
     */
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}";
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'medico_id');
    }

    /**
     * Accesor para horario completo
     */
    public function getHorarioLunesAttribute()
    {
        return optional($this->lunes_entrada)->format('H:i') . ' - ' . optional($this->lunes_salida)->format('H:i');
    }

    public function getHorarioMartesAttribute()
    {
        return optional($this->martes_entrada)->format('H:i') . ' - ' . optional($this->martes_salida)->format('H:i');
    }

    public function getHorarioMiercolesAttribute()
    {
        return optional($this->miercoles_entrada)->format('H:i') . ' - ' . optional($this->miercoles_salida)->format('H:i');
    }

    public function getHorarioJuevesAttribute()
    {
        return optional($this->jueves_entrada)->format('H:i') . ' - ' . optional($this->jueves_salida)->format('H:i');
    }

    public function getHorarioViernesAttribute()
    {
        return optional($this->viernes_entrada)->format('H:i') . ' - ' . optional($this->viernes_salida)->format('H:i');
    }

}
