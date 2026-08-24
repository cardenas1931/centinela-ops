<x-layouts.app title="Reportes — CentinelaOps">
    <h1 class="font-display text-2xl font-semibold mb-6">Reportes de disponibilidad</h1>

    @error('equipo_id')
        <div class="bg-estado-caido/10 border border-estado-caido/30 text-estado-caido text-sm rounded-md px-4 py-3 mb-6">
            {{ $message }}
        </div>
    @enderror

    <form action="{{ route('reportes.generar') }}" method="POST" class="max-w-lg space-y-4">
        @csrf

        <div>
            <label class="block text-sm text-centinela-texto-secundario mb-1">Equipo</label>
            <select name="equipo_id" class="w-full bg-centinela-superficie border border-white/10 rounded-md px-3 py-2 text-centinela-texto focus:outline-none focus:border-centinela-acento">
                @foreach ($equipos as $equipo)
                    <option value="{{ $equipo->id }}">{{ $equipo->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-centinela-texto-secundario mb-1">Desde</label>
                <input type="date" name="desde" value="{{ now()->subDays(7)->format('Y-m-d') }}"
                       class="w-full bg-centinela-superficie border border-white/10 rounded-md px-3 py-2 text-centinela-texto focus:outline-none focus:border-centinela-acento">
            </div>
            <div>
                <label class="block text-sm text-centinela-texto-secundario mb-1">Hasta</label>
                <input type="date" name="hasta" value="{{ now()->format('Y-m-d') }}"
                       class="w-full bg-centinela-superficie border border-white/10 rounded-md px-3 py-2 text-centinela-texto focus:outline-none focus:border-centinela-acento">
            </div>
        </div>

        <button type="submit" class="bg-centinela-acento text-white text-sm px-4 py-2 rounded-md hover:opacity-90">
            Descargar PDF
        </button>
    </form>
</x-layouts.app>