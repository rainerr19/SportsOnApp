<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Verification extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = "Verificación de tu Email";//el asunto del mensaje
    public $userdata;//el bojeto user recibido

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userdata)
    {
        $this->userdata = $userdata;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.verification');
    }
}
