<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Paciente extends Model
{
    protected $table = 'pacientes'; 
    protected $primaryKey = 'idPaciente';

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idPaciente', 'id');
    }
}
