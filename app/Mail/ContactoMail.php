<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactoMail extends Mailable
{
    use Queueable, SerializesModels;
   
    public $nombre;
    public $apellido;
    public $mensaje;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $nombre, String $apellido, String $mensaje)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->mensaje = $mensaje;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('system@e-track.com.ar', 'Sistema E-parking La Rioja')->subject('Sistema E-Parking La Rioja')->view('emails.contacto');
    }
}
