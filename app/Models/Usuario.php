<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuario';
    public $incrementing = true;
    protected $keyType = 'int';

    public function rol() 
    {
        return $this->belongsTo(Rol::class, 'idRol');
    }
}

