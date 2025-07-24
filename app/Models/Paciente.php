<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes'; 
    protected $primaryKey = 'idPaciente';

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idPaciente', 'idUsuario');
    }
}
