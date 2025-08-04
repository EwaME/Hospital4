<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cita;
use App\Models\Enfermedad;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consulta extends Model
{
    use SoftDeletes;
    protected $table = 'consultas';
    protected $primaryKey = 'idConsulta';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'idCita',
        'idEnfermedad',
        'diagnostico',
        'fecha',
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'idCita');
    }

    public function enfermedad()
    {
        return $this->belongsTo(Enfermedad::class, 'idEnfermedad', 'idEnfermedad');
    }
}
