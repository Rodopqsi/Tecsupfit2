<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmacionPedido extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $total;
    public $productos;

    public function __construct(array $data)
    {
        $this->nombre = $data['nombre'];
        $this->total = $data['total'];
        $this->productos = $data['productos'] ?? [];
    }

    public function build()
    {
        return $this->subject('Gracias por tu compra - TecsupFit')
                    ->view('emails.confirmacion_pedido');
    }
}