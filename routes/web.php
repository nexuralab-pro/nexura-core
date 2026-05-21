<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriberController;


Route::view('/politica-privacidad', 'privacy')->name('privacy');
Route::view('/descarga-recursos', 'download')->name('download');
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');
Route::view('/herramientas/generador-password', 'herramientas.password')->name('tools.password');
Route::view('/herramientas/escaner-puertos', 'herramientas.ports')->name('tools.ports');
Route::get('/', function () {
    // Tus posts actuales (déjalos como los tengas)
    $posts = \App\Models\Post::latest()->take(6)->get(); 
    
    // AQUÍ PEGAS TU NUEVA CONSULTA
    $videos = \App\Models\Video::where('esta_activo', true)->latest()->take(2)->get();

    // AQUÍ AGREGAS 'videos' DENTRO DE COMPACT
    return view('welcome', compact('posts', 'videos'));
});
// Página de la nota individual (donde irán los Ads pesados)
Route::get('/post/{slug}', [PostController::class, 'show'])->name('posts.show');
