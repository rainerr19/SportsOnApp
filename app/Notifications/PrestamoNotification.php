<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PrestamoNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];// se notifica por email
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {   
        if($this->estado == 'Devolución'){
            return (new MailMessage)
            ->subject('Notificación de estado de prestamo')
            ->greeting('HOLA! '. $notifiable->name)
            ->line('Lamentamos informar que el prestamo realizado ha sido  
                devuelto por el administrador.')
               // ->action('Notification Action', url('/'))
            ->line('Gracias por usar esta aplicaccion!')->line(' ')
            //->action('Restablecer contraseña', url(config('app.url').route('password.reset', $this->token, false)))
            ->line('(Si no hiciste esta acción, puedes ignorar este email.)')
            ->salutation('Saludos');
        }
        return (new MailMessage)
            ->subject('Notificación de estado de prestamo')
            ->greeting('HOLA! '. $notifiable->name)
            ->line('La razón de este mensaje es informar que el prestamo
             de solicitado ha sido ¡'.$this->estado.'!.')
               // ->action('Notification Action', url('/'))
            ->line('Gracias por usar esta aplicaccion!')->line(' ')
            //->action('Restablecer contraseña', url(config('app.url').route('password.reset', $this->token, false)))
            ->line('(Si no hiciste esta acción, puedes ignorar este email.)')
            ->salutation('Saludos');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    //actualizacion
    // public function toDatabase($notifiable)
    // {
    //     return [
    //         //
    //     ];
    // }
}
