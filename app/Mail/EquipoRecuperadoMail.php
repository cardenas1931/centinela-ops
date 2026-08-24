<?php

namespace App\Mail;

use App\Models\Equipo;
use App\Models\Incidencia;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EquipoRecuperadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Equipo $equipo,
        public Incidencia $incidencia,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "✔ {$this->equipo->nombre} se recuperó — CentinelaOps",
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.equipo-recuperado');
    }
}