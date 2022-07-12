@component('mail::message')
<div>
    <div>
        <h1 style="color: red;">SU PEDIDO HA SIDO CANCELADO</h1>
        <p>Número de orden: <a href="http://www.dev.importadorajorge.com.ar/compras/detalle/{{$order->id}}">{{$order->id}}</a></p>
        <h2>TOTAL: <strong> ${{$order->total}} </strong></h2>
    </div>
    <p style="font-weight: normal; font-size:10px;"><strong>Nombre de usuario: </strong>{{$order->user->name}} {{$order->user->last_name}}</p>
    <p style="font-weight: normal; font-size:10px;"><strong>Email asociado: </strong>{{$order->user->email}}</p>
    <p style="font-weight: normal; font-size:10px;"><strong>Su teléfono de contacto: </strong>{{$order->user->phone}}</p>
    <br>
    <hr>
    <p> <strong> Su pedido ha sido cancelado. </strong> <br> Si usted no ha solicitado la cancelación de esta orden de compra, es posible que el/los artículo/s que ha solicitado no se encuentren en stock.
    <h3> Ante cualquier consulta, por favor comuníquese con nosotros </h3>
    <a href="https://api.whatsapp.com/send?phone=541124772468">+54 11 2477-2468</a>
    <br>
    <a href="mailto:contacto@jorgeimportadora.com.ar">contacto@jorgeimportadora.com.ar</a>
    <br>
    <br>
    <h3>¡Muchas Gracias!</h3>
    <br>
    <h1> - Jorge Importadora - </h1>
</div>
@endcomponent