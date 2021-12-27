@component('mail::message')
<h1>PEDIDO ENTRANTE</h1>
<h2>Número de orden: <a href="http://www.dev.importadorajorge.com.ar/compras/detalle/{{$order->id}}">{{$order->id}}</a></h2>
<h2>Total: ${{$order->total}}</h2>
<br>
<h3>Nombre: {{$order->user->name}} {{$order->user->last_name}}</h3>
<h3>Email: {{$order->user->email}}</h3>
<h3>Teléfono: {{$order->user->phone}}</h3>
@endcomponent
