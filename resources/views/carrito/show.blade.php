@extends('layouts.master')
@section('content')

<style>
    .bd-example-modal-lg .modal-dialog{
        display: table;
        position: relative;
        margin: 0 auto;
        top: calc(50% - 24px);
    }

    .bd-example-modal-lg .modal-dialog .modal-content{
        background-color: transparent;
        border: none;
    }
</style>

<div class="__contenedor-compras">



    @if($userOrderDetails->isEmpty())
        <div><h3>Usted <b>no</b> posee productos seleccionados para iniciar una orden de compra.
            <br>
            Por favor, seleccione un producto para generar una.</h3></div>
    @else
        <section>
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
                        <td class="text-center" data-title="Nombre">{{$orderDetail->product->name}}</td>
                        <td class="text-center" data-title="Color">
                        @foreach ($rest_of_colours as $colour)
                            @if($orderDetail->colour_id == $colour->id)
                                @if($colour->name !== "Sin Color")
                                <div class="colourBox" style="background-color:{{$colour->hex}};"></div>
                                @else
                                <div class="colourBox">N/A</div>
                                @endif
                            @endif
                        @endforeach
                        </td>
                        <td class="text-center" data-title="img">
                            <a href="/productos/{{$orderDetail->product->id}}"><img src="/storage/{{$orderDetail->product->cover}}" class="__img-carrito" alt="{{$orderDetail->product->name}}"></a>
                        </td>
                        <td class="text-center" data-title="Cantidad">{{$orderDetail->quantity}}</td>
                        @if($orderDetail->product->amount != 0)
                            <td class="text-center" data-title="Total">${{number_format($orderDetail->product->amount, 2, ',', '.')}}</td>
                        @else
                            <td class="text-center" data-title="Total">N/A</td>
                        @endif

                        @if($orderDetail->product->amount*$orderDetail->quantity !== 0)
                            <td class="text-center" data-title="Total">${{number_format($orderDetail->product->amount*$orderDetail->quantity, 2, ',', '.')}}</td>
                        @else
                            <td class="text-center" data-title="Total">N/A</td>
                         @endif
                        <td class="text-center" data-title="Eliminar">
                            @if(Auth::check())

                            <a href="{{url("cart/remove/$orderDetail->id")}}">
                                <img class="__boton-eliminar" alt="delete_button" src="/img/eliminar.svg">
                            </a>

                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tbody class="separator"></tbody>
                <tbody class="last-row">
                    <tr>
                        <td>
                            <a class="back" href="{{ url()->previous() }}" role="button">
                                VOLVER
                            </a>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-weight: bold; align-text:center; text-transform:uppercase; font-family:'Roboto', sans-serif;">Monto final:</td>
                        <td class="final_ammount">${{ number_format($total, 2, ',', '.') }}</td>
                        <td>
                            <form id="" action="{{action('OrderController@update')}}" method="POST">
                                {{ method_field('PATCH') }}
                                @csrf
                                <input class="order_total" name="order_total" type="hidden" value="{{$total}}">
                                <input class="order_id" name="order_id" type="hidden" value="{{$orderShopping ?? ''}}">
                                <button id="buy" type="submit">
                                    <b>COMPRAR</b>
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    @endif
        <br>
        <br>

        <div class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" style="width: 48px">
                    <span class="fa fa-spinner fa-spin fa-3x"></span>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/preventSubmit.js')}}"></script>
@endsection
