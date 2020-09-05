<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TurnoNoty extends Notification
{
    use Queueable;
    protected $turno;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($turno)
    {
        $this->turno=$turno;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    
                    ->subject('Recordatorio de reserva de turno')
                    ->line('DETALLE DE TURNO!')
                    ->line($this->turno->comentario)
                    ->line('Fecha y hora: '.$this->turno->fecha.' a las '.$this->turno->hora)
                    ->line('Gracias por preferirnos!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
