@extends('layouts.master')
@section('content')
{{--  @dd($orderDetail, $rest_of_colours) --}}
    <section class="orderDetail" id="orderDetail">
        <h3>DETALLE DE COMPRA ORDEN N°{{$order->id}}</h3>
        @if(Auth::check() && Auth::user()->role == 9)
            <h3>Usuario:<a href="/perfil/{{$order->user->id}}"> {{$order->user->email}}</a></h3>
        @endif
        <br>
        <table id="mytable" class="table">
            <thead>
                <th class="text-center">Código</th>
                <th class="text-center">Artículo</th>
                <th class="text-center">Color</th>
                <th class="text-center">Foto</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Precio</th>
            </thead>
            <tbody style="border:none;">
                @foreach ($orderDetail as $detail)
                    <tr>
                        <td class="text-center"><b>{{$detail->code}}</b></td>
                        <td class="text-center"><b>{{$detail->name}}</b></td>
                        <td class="text-center">
                        @foreach ($rest_of_colours as $colour)
                            @if ($colour->id == $detail->colour_id)
                                <b>{{$colour->name}}</b>
                                <div style="width:25px; height:25px; background-color:{{$colour->hex}};"></div>
                            @endif
                        @endforeach
                        </td>
                        <td class="text-center">
                            <a href="/productos/{{$detail->product_id}}"><img src="/storage/{{$detail->cover}}" style="width:50px; height:50px" alt="{{$detail->name}}"></a>
                        </td>
                        <td class="text-center"><b>{{$detail->quantity}}</b></td>
                        <td class="text-center"><b>${{$detail->amount}}</b></td>
                    </tr>
               @endforeach
            </tbody>
            <tbody class="separator" style="border:none;"></tbody>
            <tbody class="last-row" style="border:none;">
                <tr>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td style="font-weight: bold; align-text:center; text-transform:uppercase; font-family:'Roboto', sans-serif; border:none;">Monto final:</td>
                    <td class="final_ammount" style="border:none;">
                        ${{$order->total}}
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="backButton">
            <a href="{{ url()->previous() }}" role="button">
                VOLVER
            </a>
        </div>
    </section>
@endsection
