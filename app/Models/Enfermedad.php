<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Consulta;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enfermedad extends Model
{
    use SoftDeletes;
    protected $table = 'enfermedades';
    protected $primaryKey = 'idEnfermedad';
    public $incrementing = true;
    protected $keyType = 'int';

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'idEnfermedad');
    }
}
