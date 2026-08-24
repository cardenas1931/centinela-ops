<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Heartbeat extends Model
{
    public $timestamps = false;

    protected $fillable = ['equipo_id', 'recibido_en'];

    protected $casts = [
        'recibido_en' => 'datetime',
    ];

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class);
    }
}