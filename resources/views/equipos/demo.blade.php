<x-layouts.app title="Modo Demo — CentinelaOps">
    <div class="bg-estado-advertencia/10 border border-estado-advertencia/30 rounded-md px-4 py-3 mb-6 text-sm text-estado-advertencia">
        ⚠ Modo Demo — los cambios aquí son simulados, no representan fallas reales.
    </div>

    @if (session('exito'))
        <div class="bg-estado-activo/10 border border-estado-activo/30 text-estado-activo text-sm rounded-md px-4 py-3 mb-6">
            {{ session('exito') }}
        </div>
    @endif

    <h1 class="font-display text-2xl font-semibold mb-6">Modo Demo</h1>

    <div class="space-y-3 max-w-2xl">
        @foreach ($equipos as $equipo)
            <div class="bg-centinela-superficie rounded-md p-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    @if ($equipo->estado_actual === 'activo')
                        <span class="flex items-center gap-1.5 text-estado-activo text-sm">
                            <span class="w-2 h-2 rounded-full bg-estado-activo animate-pulse"></span>
                        </span>
                    @else
                        <span class="flex items-center gap-1.5 text-estado-caido text-sm">
                            <span class="w-2 h-2 rounded-full bg-estado-caido"></span>
                        </span>
                    @endif
                    <span class="font-display font-medium">{{ $equipo->nombre }}</span>
                </div>

                @if ($equipo->estado_actual === 'activo')
                    <form action="{{ route('demo.forzar-caida', $equipo) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm px-4 py-2 rounded-md border border-estado-caido/30 text-estado-caido hover:bg-estado-caido/10">
                            Forzar caída
                        </button>
                    </form>
                @else
                    <form action="{{ route('demo.restaurar', $equipo) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm px-4 py-2 rounded-md border border-estado-activo/30 text-estado-activo hover:bg-estado-activo/10">
                            Restaurar
                        </button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
</x-layouts.app>