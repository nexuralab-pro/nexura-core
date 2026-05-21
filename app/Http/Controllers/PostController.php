<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('esta_activo', true)->latest()->get();
        return view('welcome', compact('posts'));
    }

   public function show($slug)
{
    $post = Post::where('slug', $slug)->firstOrFail();
    
    // Incrementa las visitas de forma segura en la base de datos
    $post->increment('visitas'); 

    return view('posts.show', compact('post'));
}
}