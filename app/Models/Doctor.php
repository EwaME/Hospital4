<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Cita;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;
    protected $table = 'doctores';
    protected $primaryKey = 'idDoctor';
    protected $fillable = ['idDoctor', 'especialidad'];
    
    public function usuario()
    {
        return $this->belongsTo(User::class, 'idDoctor', 'id');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'idDoctor', 'idDoctor');
    }
}
