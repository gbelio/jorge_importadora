@extends('layouts.master')
@section('content')
<div class="__contenedor-compras">
    <section>
        <div><h3>MI CARRITO</h3></div>
        <table id="mytable" class="table">
            <thead>
                <th class="text-center">Artículo</th>
                <th class="text-center">Foto</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Precio Unidad</th>
                <th class="text-center">Total</th>
                <th class="text-center">Eliminar</th>
            </thead>
            <tbody>
                <tr>
                    <td data-title="Nombre"><b>lalalalalal</b></td>
                    <td data-title="img">
                        <a href="/productos/"><img src="/storage/" class="__img-carrito" alt=""></a>
                    </td>
                    <td data-title="Cantidad"><b>15</b></td>
                    <td data-title="Total"><b>$500</b></td>
                    <td data-title="Total"><b>$7500</b></td>
                    <td data-title="Eliminar">
                        @if(Auth::check())
                        <b>
                        <a href="{{url("cart/remove/")}}">
                            <img class="__boton-eliminar" alt="delete_button" src="/img/eliminar.svg">
                        </a>
                        </b>
                        @endif
                    </td>
                </tr>
            </tbody>
            <tbody>
                @foreach ($userOrderDetails as $orderDetail)
                <tr>
                    <td data-title="Nombre"><b>{{$orderDetail->product->name}}</b></td>
                    <td data-title="img">
                        <a href="/productos/{{$orderDetail->product->id}}"><img src="/storage/{{$orderDetail->product->cover}}" class="__img-carrito" alt="{{$orderDetail->product->name}}"></a>
                    </td>
                    <td data-title="Cantidad"><b>{{$orderDetail->quantity}}</b></td>
                    <td data-title="Total"><b>${{$orderDetail->product->amount}}</b></td>
                    <td data-title="Total"><b>${{$orderDetail->product->amount*$orderDetail->quantity}}</b></td>
                    <td data-title="Eliminar">
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
            <tbody class="separator"></tbody>
            <tbody class="last-row">
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="final_ammount">Monto final: ${{ $total }}</td>
                    <td>
                        <form id="" action="{{action('OrderController@update')}}" method="POST">
                            {{ method_field('PATCH') }}
                            @csrf
                            <input name="order_total" type="hidden" value="{{$total}}">
                            <input name="order_id" type="hidden" value="{{$orderShopping ?? ''}}">
                            <button id="buy" type="submit">
                                <b>COMPRAR</b>
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
  {{--   <table>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Monto final: ${{ $total }}</td>
                <td>
                    <form id="" action="{{action('OrderController@update')}}" method="POST">
                        {{ method_field('PATCH') }}
                        @csrf
                        <input name="order_total" type="hidden" value="{{$total}}">
                        <input name="order_id" type="hidden" value="{{$orderShopping ?? ''}}">
                        <button id="buy" type="submit">
                            <b>COMPRAR</b>
                        </button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table> --}}
      {{--   <div>
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
 --}}
        <br>
        <br>

    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/preventSubmit.js')}}"></script>
@endsection
