<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Medicamento;
use App\Models\Consulta;

class ConsultaMedicamento extends Model
{
    //
    protected $primaryKey = 'idCMedicamento';
    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class, 'idMedicamento');
    }
    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'idConsulta');
    }
}
