<?php


use App\Http\Controllers\DemoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('equipos.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('equipos.index');
    })->name('dashboard');

    Route::middleware('admin')->group(function () {
        Route::get('/equipos/create', [EquipoController::class, 'create'])->name('equipos.create');
        Route::post('/equipos', [EquipoController::class, 'store'])->name('equipos.store');
        Route::get('/equipos/{equipo}/edit', [EquipoController::class, 'edit'])->name('equipos.edit');
        Route::put('/equipos/{equipo}', [EquipoController::class, 'update'])->name('equipos.update');
        Route::delete('/equipos/{equipo}', [EquipoController::class, 'destroy'])->name('equipos.destroy');
    });

    Route::get('/equipos/{equipo}', [EquipoController::class, 'show'])->name('equipos.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/equipos', [EquipoController::class, 'index'])->name('equipos.index');
    Route::get('/demo', [DemoController::class, 'index'])->name('demo.index');
    Route::post('/demo/equipos/{equipo}/forzar-caida', [DemoController::class, 'forzarCaida'])->name('demo.forzar-caida');
    Route::post('/demo/equipos/{equipo}/restaurar', [DemoController::class, 'restaurar'])->name('demo.restaurar');
    
});

require __DIR__.'/auth.php';