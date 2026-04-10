<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatTipoDeCancer extends Model
{
    //
    use SoftDeletes;

    protected $table = 'cat_tipos_de_cancer';

    protected $fillable = [
        'nombre'
    ];

    // En el modelo TipoCancer.php
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = mb_strtoupper($value, 'UTF-8');
    }
}
