<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Services\DisponibilidadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DemoController extends Controller
{
    public function index(): View
    {
        $equipos = Equipo::orderBy('nombre')->get();

        return view('equipos.demo', compact('equipos'));
    }

    public function forzarCaida(Equipo $equipo): RedirectResponse
    {
        if ($equipo->estado_actual === 'activo') {
            $equipo->incidencias()->create([
                'inicio_en' => now(),
                'origen' => 'forzado_demo',
            ]);

            $equipo->update([
                'estado_actual' => 'caido',
                'modo_demo_forzado' => true,
            ]);
        }

        return back()->with('exito', "Caída forzada en {$equipo->nombre} (modo demo).");
    }

    public function restaurar(Equipo $equipo, DisponibilidadService $disponibilidad): RedirectResponse
    {
        $disponibilidad->cerrarIncidenciaAbierta($equipo);

        $equipo->update([
            'estado_actual' => 'activo',
            'modo_demo_forzado' => false,
            'ultimo_heartbeat_en' => now(),
        ]);

        return back()->with('exito', "{$equipo->nombre} restaurado.");
    }
}