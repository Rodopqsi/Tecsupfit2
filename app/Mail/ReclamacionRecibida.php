<?php

namespace App\Mail;

use App\Models\Reclamacion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReclamacionRecibida extends Mailable
{
    use Queueable, SerializesModels;

    public $reclamacion;

    /**
     * Create a new message instance.
     */
    public function __construct(Reclamacion $reclamacion)
    {
        $this->reclamacion = $reclamacion;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Confirmación de Reclamación - TecsupFit')
                    ->view('emails.reclamacion_recibida');
    }
}
