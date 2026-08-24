<p>El equipo <strong>{{ $equipo->nombre }}</strong> dejó de responder.</p>

<p>
    Inicio de la caída: {{ $incidencia->inicio_en->format('d/m/Y H:i:s') }}<br>
    Umbral configurado: {{ $equipo->umbral_alerta_segundos }} segundos sin pulso
</p>

<p>Revisa el detalle en el dashboard de CentinelaOps.</p>