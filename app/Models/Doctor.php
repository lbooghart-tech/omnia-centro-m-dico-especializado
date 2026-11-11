<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors';

    protected $fillable = ['nombre', 'especialidad', 'horario', 'colegiado', 'telefono'];
}