@csrf

<div class="space-y-4 max-w-lg">
    <div>
        <label class="block text-sm text-centinela-texto-secundario mb-1">Nombre del equipo</label>
        <input type="text" name="nombre" value="{{ old('nombre', $equipo->nombre ?? '') }}"
               class="w-full bg-centinela-superficie border border-white/10 rounded-md px-3 py-2 text-centinela-texto focus:outline-none focus:border-centinela-acento">
        @error('nombre')
            <p class="text-estado-caido text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm text-centinela-texto-secundario mb-1">Tipo (opcional)</label>
        <input type="text" name="tipo" value="{{ old('tipo', $equipo->tipo ?? '') }}"
               placeholder="Ej. Servidor, Máquina industrial, Sensor IoT"
               class="w-full bg-centinela-superficie border border-white/10 rounded-md px-3 py-2 text-centinela-texto focus:outline-none focus:border-centinela-acento">
    </div>

    <div>
        <label class="block text-sm text-centinela-texto-secundario mb-1">Ubicación (opcional)</label>
        <input type="text" name="ubicacion" value="{{ old('ubicacion', $equipo->ubicacion ?? '') }}"
               class="w-full bg-centinela-superficie border border-white/10 rounded-md px-3 py-2 text-centinela-texto focus:outline-none focus:border-centinela-acento">
    </div>

    <div>
        <label class="block text-sm text-centinela-texto-secundario mb-1">Umbral de alerta (segundos)</label>
        <input type="number" name="umbral_alerta_segundos"
               value="{{ old('umbral_alerta_segundos', $equipo->umbral_alerta_segundos ?? 90) }}"
               class="w-full bg-centinela-superficie border border-white/10 rounded-md px-3 py-2 text-centinela-texto focus:outline-none focus:border-centinela-acento">
        @error('umbral_alerta_segundos')
            <p class="text-estado-caido text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex gap-3 pt-2">
        <button type="submit" class="bg-centinela-acento text-white text-sm px-4 py-2 rounded-md hover:opacity-90">
            {{ isset($equipo) ? 'Guardar cambios' : 'Registrar equipo' }}
        </button>
        <a href="{{ route('equipos.index') }}" class="text-centinela-texto-secundario text-sm px-4 py-2 hover:text-centinela-texto">
            Cancelar
        </a>
    </div>
</div>