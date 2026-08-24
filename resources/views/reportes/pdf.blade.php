<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; color: #12181F; font-size: 13px; }
        h1 { font-size: 20px; margin-bottom: 4px; }
        .subtitulo { color: #666; margin-bottom: 24px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        td, th { padding: 8px; border-bottom: 1px solid #ddd; text-align: left; }
        .metrica-grande { font-size: 28px; font-weight: bold; }
        .activo { color: #1a9e5c; }
        .caido { color: #c0392b; }
    </style>
</head>
<body>
    <h1>CentinelaOps — Reporte de disponibilidad</h1>
    <p class="subtitulo">
        Equipo: <strong>{{ $equipo->nombre }}</strong> ·
        Periodo: {{ $desde->format('d/m/Y') }} al {{ $hasta->format('d/m/Y') }}
    </p>

    <table>
        <tr>
            <th>Disponibilidad</th>
            <td class="metrica-grande {{ $resultado['porcentaje_uptime'] >= 99 ? 'activo' : '' }}">
                {{ $resultado['porcentaje_uptime'] }}%
            </td>
        </tr>
        
        <tr>
            <th>Tiempo de inactividad total</th>
            <td>{{ formatearDuracion($resultado['downtime_segundos']) }} ({{ number_format($resultado['downtime_segundos']) }} segundos)</td>
        </tr>
    </table>
    <h3 style="margin-top: 32px; font-size: 15px;">Detalle de incidencias</h3>

@if ($incidencias->isEmpty())
    <p style="color: #666;">Sin incidencias registradas en este periodo.</p>
@else
    <table>
        <tr>
            <th>Fecha y hora de inicio</th>
            <th>Duración</th>
            <th>Origen</th>
        </tr>
        @foreach ($incidencias as $incidencia)
            <tr>
                <td>{{ $incidencia->inicio_en->format('d/m/Y H:i:s') }}</td>
                <td>
                    @if ($incidencia->fin_en)
                        {{ formatearDuracion($incidencia->duracion_segundos) }}
                    @else
                        <span class="caido">Sigue en curso</span>
                    @endif
                </td>
                <td>{{ $incidencia->origen === 'forzado_demo' ? 'Simulación (Modo Demo)' : 'Detección automática' }}</td>
            </tr>
        @endforeach
    </table>
@endif
    <p style="margin-top: 40px; color: #999; font-size: 11px;">
        Generado automáticamente por CentinelaOps el {{ now()->format('d/m/Y H:i') }}
    </p>
</body>
@php
    function formatearDuracion(int $segundosTotales): string
    {
        $dias = intdiv($segundosTotales, 86400);
        $horas = intdiv($segundosTotales % 86400, 3600);
        $minutos = intdiv($segundosTotales % 3600, 60);
        $segundos = $segundosTotales % 60;

        $partes = [];
        if ($dias > 0) $partes[] = "{$dias}d";
        if ($horas > 0) $partes[] = "{$horas}h";
        if ($minutos > 0) $partes[] = "{$minutos}m";
        if ($segundos > 0 || empty($partes)) $partes[] = "{$segundos}s";

        return implode(' ', $partes);
    }
@endphp
</html>