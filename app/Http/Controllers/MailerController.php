<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailerController extends Controller
{
    static function userOrderConfirmation($order){
        $asunto = "Importadora Jorge - Orden generada exitosamente";
        $titulo = "¡Orden generada correctamente!";
        $cuerpo = "
<div>
<div>
<h1 style='color: green;'>HEMOS RECIBIDO TU PEDIDO</h1>
<h2> Te notificaremos vía mail cuando el mismo este listo para ser retirado</h2>
<p>Número de orden: <a href='http://www.dev.importadorajorge.com.ar/compras/detalle/'$order->id>$order->id</a></p>
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

    static function userOrderReady($order){
        $asunto = "Importadora Jorge - ¡Tu pedido está listo!";
        $titulo = "SU PEDIDO ESTÁ LISTO PARA SER RETIRADO";
        $cuerpo = "
<div>
<div>
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
        $asunto = "Importadora Jorge - Orden cancelada exitosamente";
        $titulo = "¡Orden cancelada correctamente!";
        $cuerpo = "
<div>
<div>
<h1 style='color: red;'>SU PEDIDO HA SIDO CANCELADO</h1>
<p>Número de orden: <a href='http://www.dev.importadorajorge.com.ar/compras/detalle/$order->id'>$order->id</a></p>
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

        $mail = Mail::to('gastonb.bkp@gmail.com');
        $mail->send(
            new \App\Mail\AlertsMailable($asunto, $titulo, $cuerpo)
        );
    }
}
