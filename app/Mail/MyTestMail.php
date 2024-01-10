<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Auth;
class MyTestMail extends Mailable
{
use Queueable, SerializesModels;


/**
* Create a new message instance.
*
* @return void
*/
public $codigo;
public function __construct($codigo)
{
$this->codigo = $codigo;

}


/**
* Build the message.
*
* @return $this
*/
public function build()
{
    $dni = Auth::user()->dni;

return $this->view('emails.test',compact('codigo'))->subject('CONFIRMACIÓN DE EMAIL');
}
}