<?php

namespace App\Services;

use App\Models\Equipo;
use App\Models\Incidencia;
use Carbon\Carbon;

class DisponibilidadService
{
    /**
     * Calcula el % de disponibilidad (uptime) de un equipo en un rango de fechas.
     * Devuelve también el downtime total en segundos y el número de incidencias.
     */
    public function calcularDisponibilidad(Equipo $equipo, Carbon $desde, Carbon $hasta): array
    {
        $segundosTotales = $desde->diffInSeconds($hasta);

        $incidencias = $equipo->incidencias()
            ->where('inicio_en', '<=', $hasta)
            ->where(function ($query) use ($desde) {
                $query->whereNull('fin_en')->orWhere('fin_en', '>=', $desde);
            })
            ->get();

        $downtimeSegundos = 0;

        foreach ($incidencias as $incidencia) {
            $inicio = $incidencia->inicio_en->max($desde);
            $fin = ($incidencia->fin_en ?? now())->min($hasta);

            if ($fin->greaterThan($inicio)) {
                $downtimeSegundos += $inicio->diffInSeconds($fin);
            }
        }

        $uptimeSegundos = max(0, $segundosTotales - $downtimeSegundos);
        $porcentajeUptime = $segundosTotales > 0
            ? round(($uptimeSegundos / $segundosTotales) * 100, 2)
            : 100;

        return [
            'porcentaje_uptime' => $porcentajeUptime,
            'downtime_segundos' => (int) round($downtimeSegundos),
            'numero_incidencias' => $incidencias->count(),
        ];
    }

    /**
     * Cierra una incidencia abierta (si existe) y calcula su duración.
     * Usado tanto por la detección automática como por el Modo Demo.
     */
    public function cerrarIncidenciaAbierta(Equipo $equipo): ?Incidencia
    {
        $incidencia = $equipo->incidencias()->abierta()->first();

        if (!$incidencia) {
            return null;
        }

        $finEn = now();
        $incidencia->update([
            'fin_en' => $finEn,
            'duracion_segundos' => $incidencia->inicio_en->diffInSeconds($finEn),
        ]);

        return $incidencia;
    }
}