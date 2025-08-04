<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Paciente;
use App\Models\Consulta;

class Medicamento extends Model
{
    use SoftDeletes;
    protected $table = 'medicamentos';
    protected $primaryKey = 'idMedicamento';
}
