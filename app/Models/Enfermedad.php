<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    protected $table = 'enfermedades';
    protected $primaryKey = 'idEnfermedad';
    public $incrementing = true;
    protected $keyType = 'int';

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'idEnfermedad');
    }
}
