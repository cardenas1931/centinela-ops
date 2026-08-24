<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'CentinelaOps' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-centinela-fondo text-centinela-texto font-sans min-h-screen">
    <header class="border-b border-white/10 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-estado-activo animate-pulse"></span>
            <span class="font-display font-semibold text-lg tracking-tight">CentinelaOps</span>
        </div>

        @auth
            <nav class="flex items-center gap-6 text-sm text-centinela-texto-secundario">
                <a href="{{ route('equipos.index') }}" class="hover:text-centinela-texto">Dashboard</a>
                <a href="{{ route('demo.index') }}" class="hover:text-centinela-texto">Modo Demo</a>
                <a href="{{ route('reportes.index') }}" class="hover:text-centinela-texto">Reportes</a>
                <a href="{{ route('profile.edit') }}" class="hover:text-centinela-texto">{{ auth()->user()->name }}</a>
                
            </nav>
        @endauth
    </header>

    <main class="p-6">
        {{ $slot }}
    </main>
</body>
</html>
