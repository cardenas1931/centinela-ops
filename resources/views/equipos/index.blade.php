<x-layouts.app title="Dashboard — CentinelaOps">
    <div class="flex items-center justify-between mb-6">
        <h1 class="font-display text-2xl font-semibold">Dashboard</h1>
        <a href="{{ route('equipos.create') }}"
           class="bg-centinela-acento text-white text-sm px-4 py-2 rounded-md hover:opacity-90">
            + Nuevo equipo
        </a>
    </div>

    @if (session('exito'))
        <div class="bg-estado-activo/10 border border-estado-activo/30 text-estado-activo text-sm rounded-md px-4 py-3 mb-6">
            {{ session('exito') }}
        </div>
    @endif

    @if ($equipos->isEmpty())
        <div class="text-center py-16 text-centinela-texto-secundario">
            <p class="mb-4">Aún no hay equipos registrados.</p>
            <a href="{{ route('equipos.create') }}" class="text-centinela-acento hover:underline">
                Registra tu primer equipo para empezar a monitorear →
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($equipos as $equipo)
                <x-tarjeta-equipo :equipo="$equipo" />
            @endforeach
        </div>
    @endif
</x-layouts.app>