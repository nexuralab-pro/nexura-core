<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validamos que sea un correo real
        $request->validate([
            'email' => 'required|email',
        ]);

        // 2. Buscamos si ya existe o lo creamos si es nuevo (evita duplicar datos)
        Subscriber::firstOrCreate([
            'email' => $request->email,
        ]);

        // 3. ¡AQUÍ ESTÁ EL DINERO! Redirección inmediata a la página de descarga con Ads
        return redirect()->route('download');
    }
}