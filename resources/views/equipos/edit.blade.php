<x-layouts.app title="Editar {{ $equipo->nombre }} — CentinelaOps">
    <h1 class="font-display text-2xl font-semibold mb-6">Editar equipo</h1>

    <form action="{{ route('equipos.update', $equipo) }}" method="POST">
        @method('PUT')
        @include('equipos._form')
    </form>
</x-layouts.app>