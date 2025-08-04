<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Cita;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use SoftDeletes;
    protected $table = 'pacientes'; 
    protected $primaryKey = 'idPaciente';
    protected $fillable = ['idPaciente', 'fechaNacimiento', 'genero'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idPaciente', 'id');
    }
    public function citas()
    {
        return $this->hasMany(Cita::class, 'idPaciente', 'idPaciente');
    }
}
