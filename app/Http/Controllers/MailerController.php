<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailerController extends Controller
{
    static function userOrderConfirmation($order){
        $asunto = "Importadora Jorge - Orden generada exitosamente";
        $titulo = "";
        $cuerpo = "
<div>
<div>
<p style='text-align:center;'>Hola, <b style='color:#4171b8;'>{$order->user->name}</b></p>
<br>
<p style='text-align:center;''>¡Tu orden fue generada con éxito!</p>
<h1 style='text-align:center; color: #25408f;'>HEMOS RECIBIDO TU PEDIDO</h1>
<br>
<p> Te notificaremos vía mail cuando el mismo este listo para ser retirado o despachado</p>
<p>Número de orden: <a href='http://www.dev.importadorajorge.com.ar/compras/detalle/{$order->id}'>$order->id</a></p>
<br>
<p style='text-transform=uppercase; color:#4171b8;'>TOTAL: <strong> $$order->total </strong></p>
<br>
<br>
<hr>
<p style='color:gainsboro;'> Ante cualquier consulta, por favor comuníquese con nosotros a través de los siguientes canales: </p>
<p style='color:gainsboro;'> Teléfono <a href='https://api.whatsapp.com/send?phone=541124772468'> +54 11 2477-2468</a> </p>
<p style='color:gainsboro;'> <a href='mailto:contacto@jorgeimportadora.com.ar'>contacto@jorgeimportadora.com.ar</a> </p>
<br>
<br>
<p style='font-variant=italic;'>¡Muchas Gracias!</p>
<br>
<br>
<hr>
</div>";

        $mail = Mail::to($order->user->email);
        $mail->send(
            new \App\Mail\AlertsMailable($asunto, $titulo, $cuerpo)
        );
    }

    static function userOrderReady($order){
        $asunto = "Importadora Jorge - ¡Tu pedido está listo!";
        $titulo = "¡CONTÁCTANOS!";
        $cuerpo = "
<div>
<div>
<h1 style='color: green;'>SU PEDIDO ESTÁ LISTO PARA SER RETIRADO</h1>
<p>Número de orden: <a href='http://www.dev.importadorajorge.com.ar/compras/detalle/{$order->id}'>{$order->id}</a></p>
<h2>TOTAL: <strong> $$order->total </strong></h2>
<h3>Dirección de retiro: <strong> Sarmiento 2441 - CP 1044 </strong></h3>
</div>
<p style='font-weight: normal; font-size:10px;'><strong>Nombre de usuario: </strong>{$order->user->name} {$order->user->last_name}</p>
<p style='font-weight: normal; font-size:10px;'><strong>Email asociado: </strong>{$order->user->email}</p>
<p style='font-weight: normal; font-size:10px;'><strong>Su teléfono de contacto: </strong>{$order->user->phone}</p>
<br>
<hr>
<h3> Ante cualquier consulta, por favor comuníquese con nosotros </h3>
<a href='https://api.whatsapp.com/send?phone=541124772468'>+54 11 2477-2468</a>
<br>
<a href='mailto:contacto@jorgeimportadora.com.ar'>contacto@jorgeimportadora.com.ar</a>
<br>
<br>
<h3>¡Muchas Gracias!</h3>
<br>
<h1> - Jorge Importadora - </h1>
</div>";

        $mail = Mail::to($order->user->email);
        $mail->send(
            new \App\Mail\AlertsMailable($asunto, $titulo, $cuerpo)
        );
    }

    static function userOrderCancelation($order){
        $asunto = "Importadora Jorge - Su orden ha sido cancelada";
        $titulo = "¡Orden cancelada correctamente!";
        $cuerpo = "
<div>
<div>
<h1 style='color: red;'>SU PEDIDO HA SIDO CANCELADO</h1>
<p>Número de orden: <a href='http://www.dev.importadorajorge.com.ar/compras/detalle/{$order->id}'>$order->id</a></p>
<h2>TOTAL: <strong> $$order->total </strong></h2>
</div>
<p style='font-weight: normal; font-size:10px;'><strong>Nombre de usuario: </strong>{$order->user->name} {$order->user->last_name}</p>
<p style='font-weight: normal; font-size:10px;'><strong>Email asociado: </strong>{$order->user->email}</p>
<p style='font-weight: normal; font-size:10px;'><strong>Su teléfono de contacto: </strong>{$order->user->phone}</p>
<br>
<hr>
<p> <strong> Su pedido ha sido cancelado. </strong> <br> Si usted no ha solicitado la cancelación de esta orden de compra, es posible que el/los artículo/s que ha solicitado no se encuentren en stock.
<h3> Ante cualquier consulta, por favor comuníquese con nosotros </h3>
<a href='https://api.whatsapp.com/send?phone=541124772468'>+54 11 2477-2468</a>
<br>
<a href='mailto:contacto@jorgeimportadora.com.ar'>contacto@jorgeimportadora.com.ar</a>
<br>
<br>
<h3>¡Muchas Gracias!</h3>
<br>
<h1> - Jorge Importadora - </h1>
</div>
";

        $mail = Mail::to($order->user->email);
        $mail->send(
            new \App\Mail\AlertsMailable($asunto, $titulo, $cuerpo)
        );
    }

    static function adminOrderReception($order){
        $asunto = "Equipo Importadora Jorge - Pedido recibido";
        $titulo = "¡Has recibido un nuevo pedido!";
        $cuerpo = "
<div>
<div>
<h1 style='color: orange;'>PEDIDO ENTRANTE</h1>
<p>Número de orden: <a href='http://www.dev.importadorajorge.com.ar/compras/detalle/$order->id'>$order->id</a></p>
<h2>TOTAL: <strong> $$order->total </strong></h2>
</div>
<p style='font-weight: normal; font-size:10px;'><strong>Nombre de usuario: </strong>{$order->user->name} {$order->user->last_name}</p>
<p style='font-weight: normal; font-size:10px;'><strong>Email asociado: </strong>{$order->user->email}</p>
<p style='font-weight: normal; font-size:10px;'><strong>Teléfono de contacto: </strong>{$order->user->phone}</p>
<br>
<hr>
<h3> Ante cualquier consulta, por favor comuníquese con nosotros </h3>
<a href='https://api.whatsapp.com/send?phone=541124772468'>+54 11 2477-2468</a>
<br>
<a href='mailto:contacto@jorgeimportadora.com.ar'>contacto@jorgeimportadora.com.ar</a>
<br>
<br>
<h3>¡Muchas Gracias!</h3>
</div>
";

        $mail = Mail::to('ventaswebij@gmail.com');
        $mail->send(
            new \App\Mail\AlertsMailable($asunto, $titulo, $cuerpo)
        );
    }
}
