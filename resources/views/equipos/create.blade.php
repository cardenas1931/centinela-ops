<x-layouts.app title="Nuevo equipo — CentinelaOps">
    <h1 class="font-display text-2xl font-semibold mb-6">Registrar nuevo equipo</h1>

    <form action="{{ route('equipos.store') }}" method="POST">
        @include('equipos._form')
    </form>
</x-layouts.app>