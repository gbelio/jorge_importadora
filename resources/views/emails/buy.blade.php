@component('mail::message')
<h1>SU PEDIDO ESTÁ LISTO PARA SER RETIRADO</h1>
<h2>Número de orden: {{$order->id}}</h2>
<br>
<h2>Dirección de retiro: Sarmiento 2441 - CP 1044</h2>
<br>
<a href="https://api.whatsapp.com/send?phone=541124772468">+54 11 2477-2468</a>
<br>
<a href="mailto:contacto@jorgeimportadora.com.ar">contacto@jorgeimportadora.com.ar</a>
<br>
<h4>Total: ${{$order->total}}</h2>
<br>
<h4>{{$order->user->name}} {{$order->user->last_name}}!</h4>
<h4>Ante cualquier duda nos comunicaremos al siguiente número:</h4>
<h4>Teléfono: {{$order->user->phone}}</h4>
Gracias,<br>
Importadora Jorge
@endcomponent
