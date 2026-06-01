<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auditor de Puertos Web - Nexura Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">

    <nav class="p-6 bg-black border-b border-orange-500">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold text-orange-500">← NEXURA LAB</a>
            <span class="text-xs font-mono text-gray-400">PORT_SCANNER v1.0</span>
        </div>
    </nav>

    <div class="flex-grow flex items-center justify-center p-4 w-full">
        <div class="max-w-lg w-full mx-auto p-6 bg-gray-950 border border-gray-800 rounded-2xl shadow-2xl my-6">
            <h2 class="text-2xl font-black text-orange-500 uppercase tracking-wider mb-2">🔒 Port Scanner Simulator</h2>
            <p class="text-xs text-gray-400 mb-6">Analiza de forma didáctica la exposición de puertos estándar en redes corporativas.</p>

            <div class="space-y-4">
                <div>
                    <label class="text-xs font-semibold text-gray-400 block mb-1">Dirección IP o Target de prueba:</label>
                    <input type="text" id="target" value="192.168.1.254" class="w-full bg-gray-900 border border-gray-800 rounded-lg px-4 py-2.5 font-mono text-sm text-white focus:outline-none focus:border-orange-500">
                </div>

                <button onclick="startScan()" class="w-full bg-orange-500 hover:bg-orange-600 text-black font-black text-xs uppercase tracking-widest py-3 rounded-lg transition-all shadow-[0_0_15px_rgba(249,115,22,0.2)]">
                    Iniciar Escaneo de Seguridad
                </button>

                <div id="console" class="hidden bg-black border border-gray-900 rounded-xl p-4 font-mono text-xs space-y-1 max-h-60 overflow-y-auto text-gray-400">
                    <p class="text-orange-500">-&gt; Inicializando escáner en Nexura Lab...</p>
                </div>
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
        function startScan() {
            const target = document.getElementById('target').value;
            const consoleBox = document.getElementById('console');
            consoleBox.classList.remove('hidden');
            consoleBox.innerHTML = `<p class="text-orange-500">-&gt; Iniciando escaneo de puertos en target: ${target}...</p>`;

            const ports = [
                { num: 21, name: 'FTP', status: 'CLOSED (Secure)' },
                { num: 22, name: 'SSH', status: 'FILTERED (Stealth)' },
                { num: 80, name: 'HTTP', status: 'OPEN (Traffic Allowed)' },
                { num: 443, name: 'HTTPS', status: 'OPEN (SSL Secured)' },
                { num: 3306, name: 'MySQL', status: 'CLOSED (Protected)' },
                { num: 8080, name: 'HTTP-Proxy', status: 'CLOSED' }
            ];

            ports.forEach((port, index) => {
                setTimeout(() => {
                    const color = port.status.includes('OPEN') ? 'text-emerald-400' : 'text-gray-500';
                    consoleBox.innerHTML += `<p>Puerto <span class="text-orange-400">${port.num}</span> (${port.name}): <span class="${color}">${port.status}</span></p>`;
                    
                    if(index === ports.length - 1) {
                        consoleBox.innerHTML += `<p class="text-emerald-500 mt-2">-&gt; [!] Escaneo finalizado. Nodo de red estable.</p>`;
                    }
                    consoleBox.scrollTop = consoleBox.scrollHeight;
                }, (index + 1) * 600);
            });
        }
    </script>
</body>
</html>