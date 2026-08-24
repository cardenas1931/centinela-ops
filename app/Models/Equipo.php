<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tipo',
        'ubicacion',
        'umbral_alerta_segundos',
        'estado_actual',
        'ultimo_heartbeat_en',
        'modo_demo_forzado',
    ];

    protected $casts = [
        'ultimo_heartbeat_en' => 'datetime',
        'modo_demo_forzado' => 'boolean',
        'umbral_alerta_segundos' => 'integer',
    ];

    public function heartbeats(): HasMany
    {
        return $this->hasMany(Heartbeat::class);
    }

    public function incidencias(): HasMany
    {
        return $this->hasMany(Incidencia::class);
    }
}