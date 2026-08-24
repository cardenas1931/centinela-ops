<?php

use App\Http\Controllers\EquipoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('equipos.index');
});

Route::middleware('auth')->group(function () {
    Route::resource('equipos', EquipoController::class);

    Route::get('/dashboard', function () {
        return redirect()->route('equipos.index');
    })->name('dashboard');
});

require __DIR__.'/auth.php';