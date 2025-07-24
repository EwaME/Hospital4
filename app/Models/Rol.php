<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'idRol';
    public $incrementing = true;
    protected $keyType = 'int';
}
