<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Bitacora extends Model
{
    protected $table = 'bitacoras';
    protected $primaryKey = 'idBitacora';
    public $timestamps = true;

    protected $fillable = [
        'idUsuario',
        'accion',
        'descripcion',
        'modelo',
        'id_relacionado',
        'ip',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'id');
    }
}
