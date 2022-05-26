@extends('layouts.master')
@section('content')
<div class="__contenedor-compras">
    <section>
        <div><h3>MI CARRITO</h3></div>
        <table id="mytable" class="table">
            <thead>
                <th class="text-center">Artículo</th>
                <th class="text-center">Color</th>
                <th class="text-center">Foto</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Precio Unidad</th>
                <th class="text-center">Total</th>
                <th class="text-center">Eliminar</th>
            </thead>
            <tbody>
                @foreach ($userOrderDetails as $orderDetail)
                <tr>
                    <td class="text-center" data-title="Nombre"><b>{{$orderDetail->product->name}}</b></td>
                    <td class="text-center" data-title="Color"><b>{{$orderDetail->colour->name}}</b></td>
                    <td class="text-center" data-title="img">
                        <a href="/productos/{{$orderDetail->product->id}}"><img src="/storage/{{$orderDetail->product->cover}}" class="__img-carrito" alt="{{$orderDetail->product->name}}"></a>
                    </td>
                    <td class="text-center" data-title="Cantidad"><b>{{$orderDetail->quantity}}</b></td>
                    <td class="text-center" data-title="Total"><b>${{$orderDetail->product->amount}}</b></td>
                    <td class="text-center" data-title="Total"><b>${{$orderDetail->product->amount*$orderDetail->quantity}}</b></td>
                    <td class="text-center" data-title="Eliminar">
                        @if(Auth::check())
                        <b>
                        <a href="{{url("cart/remove/$orderDetail->id")}}">
                            <img class="__boton-eliminar" alt="delete_button" src="/img/eliminar.svg">
                        </a>
                        </b>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
        <hr>

        <div>
            <div>
                <b>Monto final: ${{ $total }}</b>
            </div>
            <div>
                <form id="" action="{{action('OrderController@update')}}" method="POST">
                    {{ method_field('PATCH') }}
                    @csrf
                    <input name="order_total" type="hidden" value="{{$total}}">
                    <input name="order_id" type="hidden" value="{{$orderShopping ?? ''}}">
                    <button id="buy" type="submit">
                        <b>COMPRAR</b>
                    </button>
                </form>
            </div>
        </div>

        <br>
        <br>

    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/preventSubmit.js')}}"></script>
@endsection
