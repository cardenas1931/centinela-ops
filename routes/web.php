<?php

use App\Http\Controllers\EquipoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('equipos.index');
});

Route::resource('equipos', EquipoController::class);