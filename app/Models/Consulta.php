<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cita;
use App\Models\Enfermedad;

class Consulta extends Model
{
    protected $table = 'consultas';
    protected $primaryKey = 'idConsulta';
    public $incrementing = true;
    protected $keyType = 'int';

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'idCita');
    }

    public function enfermedad()
    {
        return $this->belongsTo(Enfermedad::class, 'idEnfermedad', 'idEnfermedad');
    }
}
