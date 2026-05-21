<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexura Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">

    <nav class="p-6 bg-black border-b border-orange-500">
        <h1 class="text-3xl font-bold text-orange-500 text-center">NEXURA LAB</h1>
    </nav>

    <div class="max-w-6xl mx-auto p-4">
        
        <div class="w-full h-24 bg-gray-800 my-6 flex items-center justify-center border border-dashed border-gray-600 text-gray-400">
            [ ESPACIO PARA BANNER PUBLICIDAD ADSENSE ]
        </div>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
            <h2 class="text-2xl font-semibold border-l-4 border-orange-500 pl-4">Últimas Curiosidades</h2>
            
            <div class="flex bg-gray-950 p-1 rounded-xl border border-gray-800 self-start md:self-auto font-mono text-xs shadow-md">
                <button onclick="filterCategory('todos')" id="btn-todos" class="px-4 py-2 rounded-lg bg-orange-600 text-black font-bold transition duration-200">
                    👁️ Todo
                </button>
                <button onclick="filterCategory('tech')" id="btn-tech" class="px-4 py-2 rounded-lg text-gray-400 hover:text-white transition duration-200">
                    💻 Dev & Systems
                </button>
                <button onclick="filterCategory('terror')" id="btn-terror" class="px-4 py-2 rounded-lg text-gray-400 hover:text-red-500 transition duration-200">
                    💀 Tech-Terror
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 transition-all duration-300">
            @foreach($posts as $post)
                @php
                    // Lógica del analizador de contenido para asignar categorías dinámicamente
                    $textoParaAnalizar = Str::lower($post->titulo . ' ' . $post->contenido);
                    $esTerror = Str::contains($textoParaAnalizar, ['terror', 'virus', 'hack', 'misterio', 'ataque', 'caida', 'fantasma', 'malware', 'troyano', 'ransomware']);
                    $categoria = $esTerror ? 'terror' : 'tech';
                @endphp

                <div data-category="{{ $categoria }}" class="post-card bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-orange-500/20 transition-all duration-300 transform">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $post->imagen_portada) }}" class="w-full h-48 object-cover">
                        <span class="absolute top-3 right-3 text-[10px] font-mono uppercase tracking-wider px-2 py-1 rounded font-bold shadow-md {{ $esTerror ? 'bg-red-950 border border-red-800 text-red-400' : 'bg-orange-950 border border-orange-800 text-orange-400' }}">
                            {{ $esTerror ? '💀 Tech-Terror' : '💻 Dev & Systems' }}
                        </span>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-white line-clamp-1">{{ $post->titulo }}</h3>
                        <p class="text-gray-400 text-sm mb-4">{{ Str::limit(strip_tags($post->contenido), 100) }}</p>
                        <a href="{{ route('posts.show', $post->slug) }}" class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded transition">
                            Leer más...
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <section class="my-16 grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="flex items-center gap-3">
                    <div class="w-1 h-8 bg-orange-500 rounded-full"></div>
                    <h2 class="text-2xl font-bold tracking-tight text-white">Nexura TV | Clips de Terror & Tech</h2>
                </div>

                @if(isset($videos) && $videos->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($videos as $video)
                            <div class="bg-gray-950 border border-gray-900 rounded-2xl overflow-hidden shadow-xl flex flex-col justify-between group hover:border-orange-500/50 transition-all duration-300">
                                
                                <div class="aspect-[9/16] w-full bg-black relative">
                                    @php
                                        $urlOriginal = $video->video_url;
                                        $embedUrl = '';

                                        // Motor Regex para limpiar URLs de YouTube/Shorts
                                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $urlOriginal, $matches)) {
                                            $videoId = $matches[1];
                                            $embedUrl = "https://www.youtube.com/embed/" . trim($videoId);
                                        } 
                                        // Parseador para URLs de TikTok
                                        elseif (str_contains($urlOriginal, 'tiktok.com')) {
                                            if (str_contains($urlOriginal, '/video/')) {
                                                $parts = explode('/video/', $urlOriginal);
                                                $videoId = explode('?', $parts[1])[0];
                                                $embedUrl = "https://www.tiktok.com/embed/v2/" . trim($videoId);
                                            } else {
                                                $embedUrl = $urlOriginal; 
                                            }
                                        } else {
                                            $embedUrl = $urlOriginal;
                                        }
                                    @endphp

                                    @if(!empty($embedUrl))
                                        <iframe class="w-full h-full absolute inset-0" src="{{ $embedUrl }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-900 text-gray-600 text-xs text-center p-4">
                                            Formato de enlace no soportado
                                        </div>
                                    @endif
                                </div>

                                <div class="p-4 bg-gray-900/40">
                                    <span class="text-[10px] font-mono uppercase tracking-wider px-2 py-0.5 rounded bg-gray-800 text-gray-400">{{ $video->plataforma }}</span>
                                    <h3 class="text-base font-bold text-white mt-2 line-clamp-1 group-hover:text-orange-500 transition-colors">{{ $video->titulo }}</h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-8 text-center bg-gray-900/20 border border-dashed border-gray-800 rounded-2xl text-gray-500 italic text-sm">
                        Sube tus primeros videos cortos desde el panel administrativo.
                    </div>
                @endif
            </div>

            <div class="space-y-8">
                
                <div class="bg-gradient-to-b from-gray-900 to-black border border-gray-800 rounded-2xl p-6 shadow-2xl relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-orange-500/10 rounded-full blur-xl"></div>
                    <h3 class="text-xl font-black text-orange-500 uppercase tracking-wider mb-2">🎁 Recursos Gratuitos</h3>
                    <p class="text-sm text-gray-400 mb-4">Descarga scripts de automatización, guías de ciberseguridad e imágenes exclusivas sin costo.</p>
                    
                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-950 border border-green-800 text-green-400 text-xs rounded-lg font-semibold transition-all">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('subscribe') }}" method="POST" class="space-y-3">
                        @csrf
                        <input type="email" name="email" placeholder="Tu correo de ingeniero..." required class="w-full bg-gray-950 border border-gray-800 rounded-lg px-4 py-2.5 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-orange-500 transition-colors">
                        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-black font-black text-xs uppercase tracking-widest py-3 rounded-lg transition-all shadow-[0_0_15px_rgba(249,115,22,0.2)]">
                            Desbloquear Descargas
                        </button>
                    </form>
                </div>

                <div class="bg-gray-950 border border-gray-900 rounded-2xl p-6 shadow-xl space-y-4">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <span class="text-orange-500">⚡</span> Herramientas Online
                    </h3>
                    <p class="text-xs text-gray-500">Utilidades interactivas de uso rápido. Genera contraseñas fuertes o analiza vulnerabilidades.</p>
                    
                    <div class="space-y-2">
                        <a href="{{ route('tools.password') }}" class="flex items-center justify-between p-3 bg-gray-900/50 border border-gray-800 rounded-xl hover:border-orange-500/30 transition-colors group">
                            <div class="flex items-center gap-3">
                                <span class="text-gray-600 group-hover:text-orange-500 transition-colors">🔑</span>
                                <span class="text-sm font-semibold text-gray-300 group-hover:text-white transition-colors">Generador de Passwords Pro</span>
                            </div>
                            <span class="text-xs text-gray-600 group-hover:text-orange-500">GO →</span>
                        </a>

                        <a href="{{ route('tools.ports') }}" class="flex items-center justify-between p-3 bg-gray-900/50 border border-gray-800 rounded-xl hover:border-orange-500/30 transition-colors group">
                            <div class="flex items-center gap-3">
                                <span class="text-gray-600 group-hover:text-orange-500 transition-colors">🔒</span>
                                <span class="text-sm font-semibold text-gray-300 group-hover:text-white transition-colors">Escáner de Puertos Web</span>
                            </div>
                            <span class="text-xs text-gray-600 group-hover:text-orange-500">GO →</span>
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <div class="w-full h-24 bg-gray-800 mt-12 flex items-center justify-center border border-dashed border-gray-600 text-gray-400">
            [ ESPACIO PARA BANNER PUBLICIDAD ADSENSE ]
        </div>
        
    </div>

    <script>
        function filterCategory(category) {
            const cards = document.querySelectorAll('.post-card');
            const buttons = {
                todos: document.getElementById('btn-todos'),
                tech: document.getElementById('btn-tech'),
                terror: document.getElementById('btn-terror')
            };

            // 1. Alternar estilos activos de los botones
            Object.keys(buttons).forEach(key => {
                if (key === category) {
                    if (key === 'terror') {
                        buttons[key].className = "px-4 py-2 rounded-lg bg-red-600 text-white font-bold transition duration-200";
                    } else {
                        buttons[key].className = "px-4 py-2 rounded-lg bg-orange-600 text-black font-bold transition duration-200";
                    }
                } else {
                    buttons[key].className = "px-4 py-2 rounded-lg text-gray-400 hover:text-white transition duration-200";
                    if(key === 'terror') buttons[key].className = "px-4 py-2 rounded-lg text-gray-400 hover:text-red-500 transition duration-200";
                }
            });

            // 2. Ejecutar filtros con transición de escala y opacidad
            cards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                
                if (category === 'todos' || cardCategory === category) {
                    card.style.display = 'block';
                    setTimeout(() => { 
                        card.style.opacity = '1'; 
                        card.style.transform = 'scale(1)'; 
                    }, 10);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.95)';
                    setTimeout(() => { 
                        card.style.display = 'none'; 
                    }, 200);
                }
            });
        }
    </script>
<footer class="w-full bg-black py-6 border-t border-gray-950 mt-12 text-center text-xs text-gray-600 font-mono">
    <p>&copy; 2026 Nexura Lab. Todos los derechos reservados.</p>
    <p class="mt-2">
        <a href="{{ route('privacy') }}" class="text-gray-500 hover:text-orange-500 transition mx-3 underline">
            Política de Privacidad
        </a>
    </p>
</footer>

</body>
</html>