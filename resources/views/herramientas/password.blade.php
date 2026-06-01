<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Contraseñas Pro - Nexura Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">

    <nav class="p-6 bg-black border-b border-orange-500">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold text-orange-500">← NEXURA LAB</a>
            <span class="text-xs font-mono text-gray-400">SECURE_GEN v1.0</span>
        </div>
    </nav>

    <div class="flex-grow flex items-center justify-center p-4 w-full">
        <div class="max-w-md w-full mx-auto p-6 bg-gray-950 border border-gray-800 rounded-2xl shadow-2xl my-6">
            <h2 class="text-2xl font-black text-orange-500 uppercase tracking-wider mb-2">🔑 Password Gen Pro</h2>
            <p class="text-xs text-gray-400 mb-6">Genera claves robustas con entropía alta de forma local en tu navegador.</p>

            <div class="space-y-4">
                <div class="relative">
                    <input type="text" id="password-output" readonly class="w-full bg-gray-900 border border-gray-800 rounded-lg px-4 py-3 text-lg font-mono text-emerald-400 focus:outline-none" placeholder="Haz clic en Generar">
                    <button onclick="copyToClipboard()" class="absolute right-2 top-2 bg-gray-800 hover:bg-gray-700 text-xs text-gray-300 px-3 py-1.5 rounded-md transition-colors">Copiar</button>
                </div>

                <div>
                    <div class="flex justify-between text-xs font-semibold mb-1">
                        <label class="text-gray-400">Longitud:</label>
                        <span id="length-val" class="text-orange-500 font-mono">16</span>
                    </div>
                    <input type="range" id="length" min="8" max="32" value="16" class="w-full accent-orange-500" oninput="document.getElementById('length-val').innerText = this.value">
                </div>

                <div class="space-y-2 bg-gray-900/50 p-3 rounded-xl border border-gray-900 text-sm">
                    <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" id="uppercase" checked class="accent-orange-500"> Mayúsculas (A-Z)</label>
                    <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" id="lowercase" checked class="accent-orange-500"> Minúsculas (a-z)</label>
                    <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" id="numbers" checked class="accent-orange-500"> Números (0-9)</label>
                    <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" id="symbols" checked class="accent-orange-500"> Símbolos (*, #, $, %)</label>
                </div>

                <button onclick="generatePassword()" class="w-full bg-orange-500 hover:bg-orange-600 text-black font-black text-xs uppercase tracking-widest py-3 rounded-lg transition-all shadow-[0_0_15px_rgba(249,115,22,0.2)]">
                    Generar Clave Segura
                </button>
                
                <div id="alert-copy" class="hidden text-center text-xs text-emerald-400 bg-emerald-950/30 border border-emerald-900 py-2 rounded-lg">
                    ¡Copiado al portapapeles con éxito!
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
        function generatePassword() {
            const length = document.getElementById('length').value;
            const hasUpper = document.getElementById('uppercase').checked;
            const hasLower = document.getElementById('lowercase').checked;
            const hasNumber = document.getElementById('numbers').checked;
            const hasSymbol = document.getElementById('symbols').checked;

            const upperChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            const lowerChars = 'abcdefghijklmnopqrstuvwxyz';
            const numChars = '0123456789';
            const symbolChars = '!@#$%^&*()_+~`|}{[]:;?><,./-=';

            let allowedChars = '';
            if (hasUpper) allowedChars += upperChars;
            if (hasLower) allowedChars += lowerChars;
            if (hasNumber) allowedChars += numChars;
            if (hasSymbol) allowedChars += symbolChars;

            if (allowedChars === '') {
                alert('Debes seleccionar al menos un tipo de carácter.');
                return;
            }

            let password = '';
            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * allowedChars.length);
                password += allowedChars[randomIndex];
            }

            document.getElementById('password-output').value = password;
        }

        function copyToClipboard() {
            const output = document.getElementById('password-output');
            if (!output.value) return;
            output.select();
            document.execCommand('copy');
            
            const alertBox = document.getElementById('alert-copy');
            alertBox.classList.remove('hidden');
            setTimeout(() => alertBox.classList.add('hidden'), 2000);
        }

        window.onload = generatePassword;
    </script>
</body>
</html>