<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Auth;
class PilotoMail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $usuario;
    public $clave;
    public $piloto;
    public function __construct($usuario,$clave,$piloto)
    {
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->piloto = $piloto;


    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dni = Auth::user()->dni;

        return $this->view('emails.piloto',compact('usuario','clave','piloto'))->subject('CREDENCIALES PRUEBA PILOTO');
    }
}