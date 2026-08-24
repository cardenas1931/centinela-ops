<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="border-b border-white/10 px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-estado-activo animate-pulse"></span>
                        <span class="font-display font-semibold text-lg tracking-tight">CentinelaOps</span>
                    </div>

                    @auth
                        <nav class="flex items-center gap-6 text-sm text-centinela-texto-secundario">
                            <a href="{{ route('equipos.index') }}" class="hover:text-centinela-texto">Dashboard</a>
                            <a href="{{ route('demo.index') }}" class="hover:text-centinela-texto">Modo Demo</a>
                            <a href="{{ route('profile.edit') }}" class="hover:text-centinela-texto">{{ auth()->user()->name }}</a>
                        </nav>
                    @endauth
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
