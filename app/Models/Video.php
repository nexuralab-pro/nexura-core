<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar de forma masiva.
     * Esto soluciona el MassAssignmentException.
     */
    protected $fillable = [
        'titulo',
        'slug',
        'plataforma',
        'video_url',
        'descripcion',
        'esta_activo',
    ];

    /**
     * Casteo de tipos para asegurar que 'esta_activo' 
     * se maneje correctamente como booleano.
     */
    protected $casts = [
        'esta_activo' => 'boolean',
    ];
}