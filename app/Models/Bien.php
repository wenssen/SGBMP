<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    protected $table = 'bienes';

    protected $fillable = [
        'nombre',
        'categoria',
        'ubicacion',
        'cantidad',
        'fecha_adquisicion',
        'descripcion',
    ];
}
