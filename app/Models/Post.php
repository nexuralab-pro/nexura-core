<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'titulo',
        'slug',
        'contenido',
        'imagen_portada',
        'imagen_cuerpo',
        'url_afiliado',
        'texto_boton_afiliado',
        'visitas',
        'esta_activo',
        'bloques', // <--- ¡Faltaba esta línea para permitir que Filament guarde los bloques dinámicos!
    ];

    protected $casts = [
        'bloques' => 'array',
        'esta_activo' => 'boolean', // Opcional: para asegurar que se maneje como booleano puro
    ];
}