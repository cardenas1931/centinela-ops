<?php

namespace App\Mail;

use App\Models\Equipo;
use App\Models\Incidencia;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EquipoCaidoMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Equipo $equipo,
        public Incidencia $incidencia,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "⚠ {$this->equipo->nombre} está caído — CentinelaOps",
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.equipo-caido');
    }
}