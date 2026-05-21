<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('videos', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->string('slug')->unique();
        $table->string('plataforma')->default('youtube'); // youtube, tiktok, instagram
        $table->string('video_url'); // El link del video
        $table->text('descripcion')->nullable(); // Un resumen corto de lo que trata
        $table->boolean('esta_activo')->default(true);
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
