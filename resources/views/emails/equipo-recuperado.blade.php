<p>El equipo <strong>{{ $equipo->nombre }}</strong> volvió a responder.</p>

<p>
    Duración de la caída: {{ $incidencia->duracion_segundos }} segundos<br>
    Recuperado: {{ $incidencia->fin_en->format('d/m/Y H:i:s') }}
</p>