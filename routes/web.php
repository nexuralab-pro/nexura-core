<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriberController;

// Rutas Estáticas y de Suscripción
Route::view('/politica-privacidad', 'privacy')->name('privacy');
Route::view('/descarga-recursos', 'download')->name('download');
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');

// Herramientas Online
Route::view('/herramientas/generador-password', 'herramientas.password')->name('tools.password');
Route::view('/herramientas/escaner-puertos', 'herramientas.ports')->name('tools.ports');

// Ruta del Aviso Legal (Faltaba en tu local para el link del Footer)
Route::get('/privacidad', function () {
    return view('privacy'); // Usa tu misma vista 'privacy' temporalmente para que no tire error
})->name('privacidad');

// Home Principal
Route::get('/', function () {
    $posts = \App\Models\Post::latest()->take(6)->get(); 
    $videos = \App\Models\Video::where('esta_activo', true)->latest()->take(2)->get();

    return view('welcome', compact('posts', 'videos'));
});

// Página de la nota individual
Route::get('/post/{slug}', [PostController::class, 'show'])->name('posts.show');