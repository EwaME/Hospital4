<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Medicamento;
use App\Models\Consulta;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultaMedicamento extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'idCMedicamento';
    protected $fillable = [
        'idConsulta',
        'idMedicamento',
        'cantidad',
    ];
    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class, 'idMedicamento');
    }
    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'idConsulta');
    }
}
