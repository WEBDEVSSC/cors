<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicoVacacion extends Model
{
    //
    protected $table = 'medicos_vacaciones';

    protected $fillable = [
        'medico_id',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    /**
     * Relación: una vacación pertenece a un médico
     */
    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }
}
