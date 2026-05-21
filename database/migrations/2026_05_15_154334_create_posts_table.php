<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('titulo'); 
            $table->string('slug')->unique(); 
            $table->longText('contenido'); 
            
            // Tus dos imágenes
            $table->string('imagen_portada'); 
            $table->string('imagen_cuerpo'); 
            
            // Monetización (Mercado Libre / Afiliados)
            $table->string('url_afiliado')->nullable(); 
            $table->string('texto_boton_afiliado')->default('Ver oferta en Mercado Libre');
            
            // Datos de tráfico
            $table->integer('visitas')->default(0); 
            $table->boolean('esta_activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};