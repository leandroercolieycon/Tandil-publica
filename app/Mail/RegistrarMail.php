<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrarMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $data)
    {
        $this->nombre = $data['nombre'];
        $this->url = $data['url'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('system@e-track.com.ar')->subject('Bienvenido a e-Parking La Rioja')->view('emails.registrar');
    }
}
