<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacoras';
    protected $primaryKey = 'idBitacora';
    public $timestamps = false;

    protected $fillable = [
        'idUsuario',
        'accion',
        'descripcion',
        'fechaRegistro',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario', 'idUsuario');
    }
}