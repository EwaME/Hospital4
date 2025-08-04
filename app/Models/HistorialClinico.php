<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Paciente;
use App\Models\Consulta;

class HistorialClinico extends Model
{
    use HasFactory, SoftDeletes;
    
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
