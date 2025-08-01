<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialClinico extends Model
{
    protected $table = 'historialclinico';
    protected $primaryKey = 'idHistorial';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $casts = [
    'fechaActualizacion' => 'datetime',
    ];
    public $timestamps = true;
}
