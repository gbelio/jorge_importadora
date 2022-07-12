<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailerController extends Controller
{
    static function userOrderConfirmation($order){
        $asunto = "Importadora Jorge - Orden generada exitosamente";
        $titulo = "¡Orden generada correctamente!";
        $cuerpo = "
<h1>SU PEDIDO ESTÁ LISTO PARA SER RETIRADO</h1>
<h2>Número de orden: {$order->id} </h2>
<br>
<h2>Dirección de retiro: Sarmiento 2441 - CP 1044</h2>
<br>
<br>
<a href='mailto:contacto@jorgeimportadora.com.ar'>contacto@jorgeimportadora.com.ar</a>
<br>
<h4>Total: ${$order->total}</h2>
<br>
<h4>{$order->user->name} {$order->user->last_name}!</h4>
<h4>Ante cualquier duda nos comunicaremos al siguiente número:</h4>
<h4>Teléfono: {$order->user->phone}</h4>
Gracias,<br>
Importadora Jorge
        ";
    }
}
