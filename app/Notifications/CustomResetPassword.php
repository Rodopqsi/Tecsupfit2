<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends Notification
{
    public $token;

    // 👇 Recibe el token al crear la instancia
    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Restablece tu contraseña')
            ->greeting('Hola, ' . $notifiable->name)
            ->line('Has solicitado restablecer tu contraseña.')
            ->action('Restablecer Contraseña', $url)
            ->line('Si no solicitaste esto, puedes ignorar este mensaje.');
    }
}
