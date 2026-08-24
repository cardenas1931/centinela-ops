<x-layouts.app title="{{ $equipo->nombre }} — CentinelaOps">
    <div class="flex items-center justify-between mb-6">
        <div>
            <a href="{{ route('equipos.index') }}" class="text-centinela-texto-secundario text-sm hover:text-centinela-texto">
                ← Volver al dashboard
            </a>
            <h1 class="font-display text-2xl font-semibold mt-1">{{ $equipo->nombre }}</h1>
        </div>

        @if (auth()->user()->role === 'admin')
            <div class="flex gap-3">
                <a href="{{ route('equipos.edit', $equipo) }}"
                   class="text-sm px-4 py-2 rounded-md border border-white/10 hover:border-white/30">
                    Editar
                </a>
                <form action="{{ route('equipos.destroy', $equipo) }}" method="POST"
                      onsubmit="return confirm('¿Eliminar este equipo? Esta acción no se puede deshacer.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-sm px-4 py-2 rounded-md border border-estado-caido/30 text-estado-caido hover:bg-estado-caido/10">
                        Eliminar
                    </button>
                </form>
            </div>
        @endif
    </div>

    <div class="bg-centinela-superficie rounded-md p-5 mb-6 max-w-2xl">
        <dl class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <dt class="text-centinela-texto-secundario">Estado actual</dt>
                <dd class="mt-1 {{ $equipo->estado_actual === 'activo' ? 'text-estado-activo' : 'text-estado-caido' }}">
                    {{ ucfirst($equipo->estado_actual) }}
                </dd>
            </div>
            <div>
                <dt class="text-centinela-texto-secundario">Tipo</dt>
                <dd class="mt-1">{{ $equipo->tipo ?? 'Sin tipo' }}</dd>
            </div>
            <div>
                <dt class="text-centinela-texto-secundario">Ubicación</dt>
                <dd class="mt-1">{{ $equipo->ubicacion ?? 'Sin especificar' }}</dd>
            </div>
            <div>
                <dt class="text-centinela-texto-secundario">Umbral de alerta</dt>
                <dd class="mt-1 font-mono">{{ $equipo->umbral_alerta_segundos }}s</dd>
            </div>
        </dl>
    </div>

    <h2 class="font-display text-lg font-medium mb-3">Bitácora reciente</h2>

    @if ($incidenciasRecientes->isEmpty())
        <p class="text-centinela-texto-secundario text-sm">Sin incidencias registradas todavía.</p>
    @else
        <div class="space-y-2 max-w-2xl">
            @foreach ($incidenciasRecientes as $incidencia)
                <div class="bg-centinela-superficie rounded-md p-3 flex items-center justify-between text-sm">
                    <div>
                        <span class="font-mono text-centinela-texto-secundario">{{ $incidencia->inicio_en->format('d/m/Y H:i') }}</span>
                        @if ($incidencia->origen === 'forzado_demo')
                            <span class="ml-2 text-estado-advertencia text-xs">Simulación activa</span>
                        @endif
                    </div>
                    <span class="font-mono text-centinela-texto-secundario">
                        {{ $incidencia->fin_en ? $incidencia->duracion_segundos . 's' : 'En curso' }}
                    </span>
                </div>
            @endforeach
        </div>
    @endif
</x-layouts.app>