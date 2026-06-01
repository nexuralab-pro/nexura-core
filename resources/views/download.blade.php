<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descarga tus Recursos - Nexura Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white font-sans min-h-screen flex flex-col">

    <nav class="p-6 bg-black border-b border-orange-500">
        <h1 class="text-3xl font-bold text-orange-500 text-center">NEXURA LAB</h1>
    </nav>

    <div class="max-w-3xl w-full mx-auto p-4 my-8 flex-grow flex flex-col justify-center">
        
        <div class="bg-gray-950 border border-gray-800 rounded-2xl p-8 shadow-2xl text-center relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-32 h-32 bg-orange-500/10 rounded-full blur-2xl"></div>
            
            <h2 class="text-2xl font-black text-white uppercase tracking-tight mb-2">¡Acceso Concedido, Ingeniero!</h2>
            <p class="text-gray-400 text-sm mb-6">Tu correo ha sido verificado en la base de datos de Nexura Lab.</p>

            <div id="countdown-box" class="py-6 my-4 bg-gray-900 rounded-xl border border-gray-800 inline-block px-8">
                <span class="text-xs font-mono text-gray-500 uppercase block mb-1">Preparando paquetes de descarga...</span>
                <span id="timer" class="text-4xl font-mono font-black text-orange-500">10</span><span class="text-xl font-mono text-orange-500">s</span>
            </div>

            <div id="download-action" class="hidden my-6 transition-all duration-300">
                <a href="{{ asset('recursos/Pack_NexuraLab_2026.zip') }}" download class="inline-block bg-green-600 hover:bg-green-700 text-white font-black text-sm uppercase tracking-wider py-4 px-8 rounded-xl shadow-[0_0_20px_rgba(22,163,74,0.3)] transform hover:scale-105 transition">
                    🚀 Descargar Pack Completo (Scripts + Guías)
                </a>
            </div>

            <div class="mt-8 pt-8 border-t border-gray-900 text-left">
                <h3 class="text-orange-500 font-bold text-sm uppercase font-mono tracking-wider mb-2">⚡ Recomendación del Lab:</h3>
                <p class="text-xs text-gray-400 mb-4">Para correr los scripts de automatización e historias de terror técnico sin caídas de red, te sugiero desplegarlos en un servidor VPS dedicado y seguro.</p>
                
                <a href="https://www.digitalocean.com" target="_blank" class="inline-flex items-center justify-between w-full p-4 bg-gray-900 border border-gray-800 rounded-xl hover:border-orange-500/30 transition group">
                    <span class="text-xs font-bold text-gray-300 group-hover:text-white transition">Desplegar en VPS con $200 USD de Crédito Gratis</span>
                    <span class="text-xs text-orange-500 font-mono">RECLAMAR ➔</span>
                </a>
            </div>
        </div>

    </div>

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

    <script>
        let timeLeft = 10;
        const timerElement = document.getElementById('timer');
        const countdownBox = document.getElementById('countdown-box');
        const downloadAction = document.getElementById('download-action');

        const countdown = setInterval(() => {
            timeLeft--;
            timerElement.textContent = timeLeft;

            if (timeLeft <= 0) {
                clearInterval(countdown);
                countdownBox.classList.add('hidden');
                downloadAction.classList.remove('hidden');
            }
        }, 1000);
    </script>
</body>
</html>