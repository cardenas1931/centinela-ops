<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Incidencia extends Model
{
    protected $fillable = [
        'equipo_id',
        'inicio_en',
        'fin_en',
        'duracion_segundos',
        'origen',
        'notificacion_enviada',
    ];

    protected $casts = [
        'inicio_en' => 'datetime',
        'fin_en' => 'datetime',
        'notificacion_enviada' => 'boolean',
    ];

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class);
    }

    // Scope para encontrar la incidencia sin cerrar de un equipo
    public function scopeAbierta(Builder $query): Builder
    {
        return $query->whereNull('fin_en');
    }
}