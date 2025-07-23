<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Paciente;
use App\Models\Doctor;

class Cita extends Model
{
    protected $table = 'citas';
    protected $primaryKey = 'idCita';
    public $incrementing = true;
    protected $keyType = 'int';

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'idPaciente', 'idPaciente');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'idDoctor', 'idDoctor');
    }
}
