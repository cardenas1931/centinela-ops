<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipoRequest;
use App\Models\Equipo;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EquipoController extends Controller
{
    public function index(): View
    {
        $equipos = Equipo::orderBy('nombre')->get();

        return view('equipos.index', compact('equipos'));
    }

    public function create(): View
    {
        return view('equipos.create');
    }

    public function store(StoreEquipoRequest $request): RedirectResponse
    {
        Equipo::create($request->validated());

        return redirect()->route('equipos.index')
            ->with('exito', 'Equipo registrado correctamente.');
    }

    public function show(Equipo $equipo): View
    {
        $incidenciasRecientes = $equipo->incidencias()
            ->latest('inicio_en')
            ->limit(10)
            ->get();

        return view('equipos.show', compact('equipo', 'incidenciasRecientes'));
    }

    public function edit(Equipo $equipo): View
    {
        return view('equipos.edit', compact('equipo'));
    }

    public function update(StoreEquipoRequest $request, Equipo $equipo): RedirectResponse
    {
        $equipo->update($request->validated());

        return redirect()->route('equipos.index')
            ->with('exito', 'Equipo actualizado correctamente.');
    }

    public function destroy(Equipo $equipo): RedirectResponse
    {
        $equipo->delete();

        return redirect()->route('equipos.index')
            ->with('exito', 'Equipo eliminado.');
    }
}