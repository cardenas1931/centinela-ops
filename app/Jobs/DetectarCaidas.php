<?php

namespace App\Jobs;

use App\Mail\EquipoCaidoMail;
use App\Mail\EquipoRecuperadoMail;
use App\Models\Equipo;
use App\Services\DisponibilidadService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class DetectarCaidas implements ShouldQueue
{
    use Queueable;

    public function handle(DisponibilidadService $disponibilidad): void
    {
        Equipo::where('modo_demo_forzado', false)->each(function (Equipo $equipo) use ($disponibilidad) {
            $sinPulso = $equipo->ultimo_heartbeat_en === null
                || $equipo->ultimo_heartbeat_en->diffInSeconds(now()) > $equipo->umbral_alerta_segundos;

            if ($sinPulso && $equipo->estado_actual === 'activo') {
                $incidencia = $equipo->incidencias()->create([
                    'inicio_en' => now(),
                    'origen' => 'automatico',
                ]);

                $equipo->update(['estado_actual' => 'caido']);

                Mail::to($this->correoDestino())->queue(new EquipoCaidoMail($equipo, $incidencia));
                $incidencia->update(['notificacion_enviada' => true]);

                return;
            }

            if (!$sinPulso && $equipo->estado_actual === 'caido') {
                $incidencia = $disponibilidad->cerrarIncidenciaAbierta($equipo);
                $equipo->update(['estado_actual' => 'activo']);

                if ($incidencia) {
                    Mail::to($this->correoDestino())->queue(new EquipoRecuperadoMail($equipo, $incidencia));
                }
            }
        });
    }

    private function correoDestino(): string
    {
        // Por ahora, correo fijo; en el futuro se puede leer de configuraciones o del admin.
        return config('mail.from.address');
    }
}