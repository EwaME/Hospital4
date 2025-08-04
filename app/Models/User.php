<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Models\Rol;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $fillable = [
        'nombre',
        'usuario',
        'telefono',
        'email',
        'password',
        'idRol',
        'activo',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'idRol');
    }

    public function paciente()
    {
        return $this->hasOne(Paciente::class, 'idPaciente', 'id');
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'idDoctor', 'id');
    }

    public function administrador()
    {
        return $this->hasOne(Administrador::class, 'idUsuario', 'id');
    }

}
