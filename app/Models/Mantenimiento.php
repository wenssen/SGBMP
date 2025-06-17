<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'bien_id',
        'tipo',
        'fecha_programada',
        'estado',
        'responsable',
        'observaciones',
    ];

    // Relación con el modelo Bien
    public function bien()
    {
        return $this->belongsTo(Bien::class);
    }
}
