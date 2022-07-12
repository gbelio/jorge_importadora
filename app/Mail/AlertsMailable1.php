<?php
namespace App\Mail;
ini_set('max_execution_time', 120);
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Storage;

class MailGenerico extends Mailable

{
    use Queueable, SerializesModels;
    public $theme = 'default';
    public function __construct($asunto, $titulo, $cuerpo)
    {
        $this->asunto = $asunto;
        $this->titulo = $titulo;
        $this->cuerpo = $cuerpo;
    }

    public function build()

    {
        $plantilla = 'emails.mailGenerico';
        return $this->markdown($plantilla)
            ->with('titulo', $this->titulo)
            ->with('cuerpo', $this->cuerpo)
            ->from('notificacion@importadorajorge.com.ar', 'Importadora Jorge')
            ->subject( $this->asunto );
    }
}
