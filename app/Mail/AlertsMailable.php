<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlertsMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->order->status == 3){
            $subject="Importadora Jorge: Pedido generado";
            return $this->markdown('emails.buy')->subject($subject);
        }
        $subject="Pedido realizado por: ".$this->order->user->email;
        return $this->markdown('emails.sale')->subject($subject);
    }
}
