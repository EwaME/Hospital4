<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Doctor extends Model
{
    protected $table = 'doctores';
    protected $primaryKey = 'idDoctor';
    protected $fillable = ['idDoctor', 'especialidad'];
    
    public function usuario()
    {
        return $this->belongsTo(User::class, 'idDoctor', 'id');
    }

}
