<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Administrador extends Model
{
    use SoftDeletes;
    protected $table = 'administradores';
    protected $primaryKey = 'idAdministrador';
    protected $fillable = [
        'idUsuario',
        'cargo'
    ];

    // Relación con User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'id');
    }
}
