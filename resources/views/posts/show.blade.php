<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->titulo }} | Nexura Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white leading-relaxed flex flex-col min-h-screen">

    <nav class="p-4 bg-black border-b border-orange-500 sticky top-0 z-50">
        <a href="{{ url('/') }}" class="text-orange-500 font-bold hover:text-orange-400">← NEXURA LAB | TECH & TERROR</a>
    </nav>

    <article class="max-w-4xl mx-auto p-6 flex-grow w-full">

        <h1 class="text-4xl md:text-6xl font-black mb-6 text-orange-500 leading-tight tracking-tighter mt-6">{{ $post->titulo }}</h1>
        
        <div class="rounded-2xl overflow-hidden shadow-2xl mb-10 border border-gray-800">
            <img src="/storage/{{ $post->imagen_portada }}" class="w-full object-cover">
        </div>

        <div class="max-w-none text-xl mb-12 text-gray-300 space-y-8">
            
            {{-- Renderizado del contenido heredado --}}
            <div class="prose prose-invert max-w-none mb-6">
                {!! $post->contenido !!}
            </div>

            @if($post->bloques)
                @foreach($post->bloques as $bloque)
                    
                    {{-- 1. BLOQUE PÁRRAFO --}}
                    @if($bloque['type'] === 'parrafo')
                        <div class="prose prose-invert max-w-none">
                            <p>{!! nl2br(e($bloque['data']['contenido'])) !!}</p>
                        </div>
                    @endif

                    {{-- 2. BLOQUE IMAGEN EXTRA --}}
                    @if($bloque['type'] === 'imagen')
                        <div class="rounded-2xl overflow-hidden shadow-2xl my-6 border border-gray-800">
                            <img src="/storage/{{ $bloque['data']['ruta'] }}" class="w-full object-cover">
                            @if(!empty($bloque['data']['pie_foto']))
                                <p class="text-sm text-gray-500 text-center mt-2 italic">{{ $bloque['data']['pie_foto'] }}</p>
                            @endif
                        </div>
                    @endif

                    {{-- 3. BLOQUE VIDEO --}}
                    @if($bloque['type'] === 'video')
                        <div class="rounded-2xl overflow-hidden shadow-2xl my-6 aspect-video border border-gray-800">
                            @php
                                $url = $bloque['data']['url'];
                                $embedUrl = $url;
                                if (str_contains($url, 'youtube.com/watch?v=')) {
                                    $videoId = explode('v=', $url)[1];
                                    $videoId = explode('&', $videoId)[0];
                                    $embedUrl = "https://www.youtube.com/embed/" . $videoId;
                                } elseif (str_contains($url, 'youtu.be/')) {
                                    $videoId = explode('youtu.be/', $url)[1];
                                    $embedUrl = "https://www.youtube.com/embed/" . $videoId;
                                }
                            @endphp
                            <iframe class="w-full h-full" src="{{ $embedUrl }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    @endif

                    {{-- 4. BLOQUE ALERTA / DESTACADO --}}
                    @if($bloque['type'] === 'alerta')
                        <div class="bg-black/60 border-l-4 border-red-500 p-6 rounded-r-2xl my-8 shadow-lg">
                            <h4 class="text-red-500 font-black tracking-wider uppercase text-sm mb-2">
                                ⚠️ {{ $bloque['data']['titulo_alerta'] }}
                            </h4>
                            <p class="text-gray-200 italic font-medium">
                                {{ $bloque['data']['texto_alerta'] }}
                            </p>
                        </div>
                    @endif

                    {{-- 5. BLOQUE DE ANUNCIO DINÁMICO (Oculto hasta aprobación) --}}
                    @if($bloque['type'] === 'bloque_adsense' && !empty($bloque['data']['codigo_anuncio']))
                        <div class="w-full flex flex-col items-center justify-center my-10">
                            {!! $bloque['data']['codigo_anuncio'] !!}
                        </div>
                    @endif

                @endforeach
            @endif
        </div>

        <div class="bg-black/40 p-4 border-l-4 border-orange-600 my-10 rounded-r-lg">
            <p class="text-xs text-orange-500 font-bold mb-2 uppercase">Recomendado para ti:</p>
            <div class="flex items-center gap-4">
                <div class="w-20 h-20 bg-gray-800 rounded shrink-0 border border-gray-700 flex items-center justify-center text-xl">🛡️</div>
                <div>
                    <p class="text-sm font-semibold">Análisis Avanzado de Seguridad</p>
                    <p class="text-xs text-gray-500">Mantente al tanto de las últimas metodologías de protección de servidores en Nexura Lab.</p>
                </div>
            </div>
        </div>

        <div class="rounded-2xl overflow-hidden shadow-2xl mb-12 border border-gray-800">
            <img src="/storage/{{ $post->imagen_cuerpo }}" class="w-full object-cover">
        </div>

        @if($post->url_afiliado)
            <div class="bg-gradient-to-br from-orange-600 via-orange-700 to-black p-1 rounded-3xl my-14">
                <div class="bg-gray-900 p-8 rounded-[22px] text-center">
                    <h3 class="text-3xl font-black mb-4 text-white uppercase italic">¡Consíguelo ahora!</h3>
                    <p class="text-gray-400 mb-8">No dejes pasar esta oferta especial recomendada por Nexura Lab.</p>
                    <a href="{{ $post->url_afiliado }}" target="_blank" class="bg-orange-500 text-black text-2xl font-black py-4 px-10 rounded-full hover:bg-orange-400 transition-all shadow-[0_0_20px_rgba(249,115,22,0.4)] inline-block uppercase tracking-widest">
                        {{ $post->texto_boton_afiliado ?? 'VER PRECIO EN MERCADO LIBRE' }}
                    </a>
                </div>
            </div>
        @endif

    </article>

    <footer class="w-full bg-black py-6 border-t border-gray-950 text-center text-xs text-gray-600 font-mono mt-auto">
        <p>&copy; 2026 Nexura Lab. Todos los derechos reservados.</p>
        <p class="mt-2 space-x-3">
            <a href="{{ route('privacy') }}" class="text-gray-500 hover:text-orange-500 transition underline">
                Política de Privacidad
            </a>
            <span class="text-gray-800">|</span>
            <a href="{{ route('privacidad') }}" class="text-gray-500 hover:text-orange-500 transition underline">
                Aviso Legal
            </a>
        </p>
    </footer>

</body>
</html>