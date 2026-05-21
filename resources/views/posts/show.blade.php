<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->titulo }} | Nexura Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .ads-glow { box-shadow: 0 0 15px rgba(255, 165, 0, 0.1); }
    </style>
</head>
<body class="bg-gray-900 text-white leading-relaxed">

    <nav class="p-4 bg-black border-b border-orange-500 sticky top-0 z-50">
      <a href="{{ url('/') }}" class="text-orange-500 font-bold hover:text-orange-400">← NEXURA LAB | TECH & TERROR</a>
    </nav>

    <article class="max-w-4xl mx-auto p-6">
        <div class="w-full min-h-[90px] bg-gray-800/50 my-6 flex flex-col items-center justify-center border border-dashed border-gray-700 rounded-lg text-gray-500 ads-glow">
            <span class="text-xs font-mono uppercase mb-1">Publicidad de Google</span>
            <div class="text-sm italic"> Aquí va el banner horizontal de 728x90 </div>
        </div>

        <h1 class="text-4xl md:text-6xl font-black mb-6 text-orange-500 leading-tight tracking-tighter">{{ $post->titulo }}</h1>
        
        <div class="rounded-2xl overflow-hidden shadow-2xl mb-10 border border-gray-800">
            <img src="/storage/{{ $post->imagen_portada }}" class="w-full object-cover">
        </div>

        <div class="max-w-none text-xl mb-12 text-gray-300 space-y-8">
            
            {{-- Renderizado del contenido viejo (por si acaso) --}}
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

                    {{-- 5. BLOQUE DE ANUNCIO MANUAL --}}
                    @if($bloque['type'] === 'bloque_adsense')
                        <div class="w-full flex flex-col items-center justify-center my-10 min-h-[250px] bg-gray-800/20 p-4 border border-gray-800 rounded-xl">
                            <span class="text-[10px] font-mono text-gray-600 uppercase tracking-widest mb-2">Anuncio Premium Recomendado</span>
                            {!! $bloque['data']['codigo_anuncio'] !!}
                        </div>
                    @endif

                @endforeach
            @endif
        </div>

        <div class="bg-black/40 p-4 border-l-4 border-orange-600 my-10 rounded-r-lg">
            <p class="text-xs text-orange-500 font-bold mb-2 uppercase">Recomendado para ti:</p>
            <div class="flex items-center gap-4">
                <div class="w-20 h-20 bg-gray-700 rounded shrink-0"></div>
                <div>
                    <p class="text-sm font-semibold">¿Quieres proteger tu PC de este virus?</p>
                    <p class="text-xs text-gray-500">Haz clic para ver las mejores ofertas en Antivirus 2026.</p>
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

        <div class="w-full h-64 bg-gray-800/30 my-12 flex items-center justify-center border border-gray-700 rounded-lg text-gray-600">
            <div class="text-center">
                <p class="text-xs mb-2">Anuncios que te pueden interesar</p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="w-32 h-32 bg-gray-700/50 rounded"></div>
                    <div class="w-32 h-32 bg-gray-700/50 rounded"></div>
                </div>
            </div>
        </div>

    </article>

    <footer class="p-12 bg-black text-center text-gray-600 border-t border-gray-900">
        Nexura Lab © 2026 - Sistemas y Tecnología.
    </footer>

</body>
</html>