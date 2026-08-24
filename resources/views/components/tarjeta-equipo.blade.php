@props(['equipo'])

@php
    $esActivo = $equipo->estado_actual === 'activo';
@endphp

<div class="bg-centinela-superficie rounded-md p-4 border border-white/5">
    <div class="flex items-center justify-between mb-3">
        <h3 class="font-display font-medium text-centinela-texto">{{ $equipo->nombre }}</h3>

        @if ($esActivo)
            <span class="flex items-center gap-1.5 text-estado-activo text-sm">
                <span class="w-2 h-2 rounded-full bg-estado-activo animate-pulse"></span>
                Activo
            </span>
        @else
            <span class="flex items-center gap-1.5 text-estado-caido text-sm">
                <span class="w-2 h-2 rounded-full bg-estado-caido"></span>
                Caído
            </span>
        @endif
    </div>

    <p class="text-centinela-texto-secundario text-sm mb-1">
        {{ $equipo->tipo ?? 'Sin tipo' }} @if($equipo->ubicacion) · {{ $equipo->ubicacion }} @endif
    </p>

    <p class="font-mono text-xs text-centinela-texto-secundario">
        Último pulso:
        {{ $equipo->ultimo_heartbeat_en?->diffForHumans() ?? 'Sin registrar' }}
    </p>

    <a href="{{ route('equipos.show', $equipo) }}" class="inline-block mt-3 text-centinela-acento text-sm hover:underline">
        Ver detalle →
    </a>
</div>