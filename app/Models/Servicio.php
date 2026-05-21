<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    // Esta línea es la que soluciona el error:
    protected $fillable = [
        'nombre',
        'precio',
        'descripcion', // Agrégalo si también lo vas a usar
    ];
}