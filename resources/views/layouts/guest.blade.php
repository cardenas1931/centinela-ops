<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'CentinelaOps') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-centinela-fondo text-centinela-texto font-sans antialiased">
        <div class="min-h-screen flex flex-col justify-center items-center px-4">
            <div class="flex items-center gap-2 mb-8">
                <span class="w-2.5 h-2.5 rounded-full bg-estado-activo animate-pulse"></span>
                <span class="font-display font-semibold text-xl tracking-tight">CentinelaOps</span>
            </div>

            <div class="w-full sm:max-w-md px-6 py-6 bg-centinela-superficie border border-white/5 rounded-md">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>