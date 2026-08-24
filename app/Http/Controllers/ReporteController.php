<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Services\DisponibilidadService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ReporteController extends Controller
{
    public function index(): View
    {
        $equipos = Equipo::orderBy('nombre')->get();

        return view('reportes.index', compact('equipos'));
    }

    public function generar(Request $request, DisponibilidadService $disponibilidad): Response
    {
        $validado = $request->validate([
            'equipo_id' => ['required', 'exists:equipos,id'],
            'desde' => ['required', 'date'],
            'hasta' => ['required', 'date', 'after_or_equal:desde'],
        ]);

        $equipo = Equipo::findOrFail($validado['equipo_id']);
        $desde = Carbon::parse($validado['desde'])->startOfDay();
        $hasta = Carbon::parse($validado['hasta'])->endOfDay();

        $resultado = $disponibilidad->calcularDisponibilidad($equipo, $desde, $hasta);
            $incidencias = $equipo->incidencias()
        ->where('inicio_en', '<=', $hasta)
        ->where(function ($query) use ($desde) {
            $query->whereNull('fin_en')->orWhere('fin_en', '>=', $desde);
        })
        ->orderBy('inicio_en')
        ->get();

        $pdf = Pdf::loadView('reportes.pdf', [
            'equipo' => $equipo,
            'desde' => $desde,
            'hasta' => $hasta,
            'resultado' => $resultado,
            'incidencias' => $incidencias,
        ]);

        $nombreArchivo = 'reporte-'.str($equipo->nombre)->slug().'-'.$desde->format('Y-m-d').'.pdf';

        return $pdf->download($nombreArchivo);
    }
}