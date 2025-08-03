<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistorialClinico extends Model
{
    use HasFactory;
    
    protected $table = 'historialclinico';
    protected $primaryKey = 'idHistorial';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $casts = [
    'fechaActualizacion' => 'datetime',
    ];
    public $timestamps = true;
    protected $fillable = [
        'idPaciente', 
        'resumen',
    ];

    public function paciente()
    {
        return $this->belongsTo(\App\Models\Paciente::class, 'idPaciente');
    }
}
