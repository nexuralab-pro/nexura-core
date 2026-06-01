<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidad - Nexura Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col">

    <nav class="p-6 bg-black border-b border-orange-500">
        <h1 class="text-3xl font-bold text-orange-500 text-center">
            <a href="{{ url('/') }}">NEXURA LAB</a>
        </h1>
    </nav>

    <div class="max-w-4xl mx-auto p-6 my-12 bg-gray-950 border border-gray-800 rounded-2xl shadow-2xl flex-grow w-full md:w-auto">
        <h2 class="text-3xl font-black text-orange-500 uppercase tracking-wider mb-6 border-l-4 border-orange-500 pl-4">
            Política de Privacidad
        </h2>
        
        <p class="text-gray-400 text-sm mb-8 font-mono">Última actualización: Mayo 2026</p>

        <div class="space-y-6 text-gray-300 text-sm leading-relaxed">
            
            <section>
                <h3 class="text-lg font-bold text-white mb-2">1. Información que Recolectamos</h3>
                <p>En <strong>Nexura Lab</strong>, la privacidad de nuestros usuarios es prioridad. Cuando te registras en nuestra sección de "Recursos Gratuitos", recolectamos únicamente tu dirección de correo electrónico de manera voluntaria para gestionar el envío de utilidades, scripts y noticias tecnológicas.</p>
            </section>

            <section>
                <h3 class="text-lg font-bold text-white mb-2">2. Uso de la Información</h3>
                <p>Tu correo electrónico se almacena de forma segura en nuestras bases de datos con el único propósito de enviarte el contenido solicitado y actualizaciones de la plataforma. Jamás venderemos, rentaremos ni compartiremos tu información con terceros.</p>
            </section>

            <section>
                <h3 class="text-lg font-bold text-white mb-2">3. Cookies y Publicidad de Terceros (Google AdSense)</h3>
                <p>Este sitio web utiliza servicios publicitarios de terceros, específicamente <strong>Google AdSense</strong>. Google, como proveedor asociado, utiliza cookies para publicar anuncios en este sitio basados en las visitas previas del usuario a este u otros sitios web de Internet.</p>
                <p class="mt-2">Los usuarios pueden inhabilitar el uso de la cookie de DART accediendo al anuncio de Google y a la política de privacidad de la red de contenido. Si deseas más información sobre cómo Google gestiona los datos de los anuncios, puedes consultar su política oficial.</p>
            </section>

            <section>
                <h3 class="text-lg font-bold text-white mb-2">4. Control de tus Datos</h3>
                <p>En cualquier momento puedes ejercer tu derecho a darte de baja de nuestra lista de suscriptores o solicitar la eliminación total de tu correo de nuestros sistemas. Para hacerlo, puedes contactarnos directamente a través del soporte técnico de la plataforma.</p>
            </section>

            <section class="pt-6 border-t border-gray-900">
                <a href="{{ url('/') }}" class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-bold py-2.5 px-6 rounded-xl transition font-mono text-xs uppercase tracking-wider">
                    ← Volver al Inicio
                </a>
            </section>
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

</body>
</html>