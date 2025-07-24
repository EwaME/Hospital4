<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctores';
    protected $primaryKey = 'idDoctor';

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idDoctor', 'idUsuario');
    }

}
