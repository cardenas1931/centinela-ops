<?php

namespace App\Jobs;

use App\Models\Equipo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SimularHeartbeats implements ShouldQueue
{
    use Queueable;

    // Probabilidad de que un equipo "se salte" su pulso en este ciclo (simula una falla real)
    private const PROBABILIDAD_FALLO = 0.15;

    public function handle(): void
    {
        Equipo::where('modo_demo_forzado', false)->each(function (Equipo $equipo) {
            if (mt_rand() / mt_getrandmax() < self::PROBABILIDAD_FALLO) {
                return; // se salta el pulso este ciclo, simulando una falla
            }

            $ahora = now();

            $equipo->heartbeats()->create(['recibido_en' => $ahora]);
            $equipo->update(['ultimo_heartbeat_en' => $ahora]);
        });
    }
}