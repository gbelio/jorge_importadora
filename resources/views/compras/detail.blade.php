@extends('layouts.master')
@section('content')
    <section style="margin-top: 200px">
        <h3>DETALLE DE COMPRA ORDEN N°{{$order->id}}</h3>
        @if(Auth::check() && Auth::user()->role == 9)
            <h3>Usuario:<a href="/perfil/{{$order->user->id}}"> {{$order->user->email}}</a></h3>
        @endif
        <br>
        <table id="mytable" class="table">
            <thead>
                <th class="text-center">Artículo</th>
                <th class="text-center">Color</th>
                <th class="text-center">Foto</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Precio</th>
            </thead>
            <tbody>
                @foreach ($orderDetail as $detail)
                    <tr>
                        <td class="text-center"><b>{{$detail->name}}</b></td>
                        <td class="text-center"><b>{{$detail->colour->name}}</b></td>
                        <td class="text-center">
                            <a href="/productos/{{$detail->product_id}}"><img src="/storage/{{$detail->cover}}" style="width:50px; height:50px" alt="{{$detail->name}}"></a>
                        </td>
                        <td class="text-center"><b>{{$detail->quantity}}</b></td>
                        <td class="text-center"><b>${{$detail->amount}}</b></td>
                    </tr>
               @endforeach
            </tbody>
        </table>
    </section>
            <hr>
            <div>
                <div>
                    <b>Monto final: ${{$order->total}}</b>
                </div>
            </div>
            <div>
                <a href="{{ url()->previous() }}" role="button">
                    VOLVER
                </a>
            </div>
            <br>
            <br>
        </section>
@endsection
