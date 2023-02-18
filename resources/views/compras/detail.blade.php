@extends('layouts.master')
@section('content')
{{-- @dd($user) --}}
    <section class="orderDetail" id="orderDetail">
        <h3>DETALLE DE COMPRA ORDEN N°{{$order->id}}</h3>
        <br>
        <table id="mytable" class="table">
            <thead>
                <th class="text-center d-none d-md-block" style="width: 100%;">Código</th>
                <th class="text-center">Artículo</th>
                <th class="text-center">Color</th>
                <th class="text-center">Foto</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Precio</th>
            </thead>
            <tbody style="border:none;">
                @foreach ($orderDetail as $detail)
                    <tr>
                        <td class="text-center d-none d-md-block" style="width: 100%;"><b>{{$detail->code}}</b></td>
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
                        <td class="text-center"><b>${{number_format($detail->amount, 2, ',', '.')}}</b></td>
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
                        ${{number_format($order->total, 2, ',', '.')}}
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        @if(Auth::check() && Auth::user()->role == 9)
        <h3 class="usuario_order">Cliente:<a href="/usuarios/editar/{{$order->user->id}}"> {{$order->user->email}}</a></h3>
        @endif
        <div class="user_details_compras">
            <div> 
                <p>Nombre y Apellido</p> 
                <div>{{$user->name}} {{$user->last_name}}</div>
            </div>
            <div> 
                <p>Razón Social</p> 
                <div>{{$user->name}} {{$user->business_name}}</div>
            </div>
            <div> 
                <p>Dirección</p> 
                <div>{{$user->address}}</div>
            </div>
            <div class="double">
                <div> 
                    <p>Localidad</p> 
                    <div>{{$user->department}}</div>
                </div>
                <div> 
                    <p>Provincia</p> 
                    <div>{{$user->province}}</div>
                </div>
            </div>
            <div class="double">
                <div> 
                    <p>Código postal</p> 
                    <div>{{$user->zip_code}}</div>
                </div>
                <div> 
                    <p>Nombre de transporte</p> 
                    <div>{{$user->shipment}}</div>
                </div>
            </div>
            <div class="iva_section">
                <p>Tipo de IVA</p>
                <div>
                    <div> 
                       <label><input type="checkbox" @if($user->iva == "ri") checked class="iva_active" @endif disabled> RI </label>
                       <label><input type="checkbox" @if($user->iva == "mt") checked class="iva_active" @endif disabled> Monotributo </label>
                       <div>
                            <p>Nro CUIT</p> 
                            <div>@if($user->iva == "ri" || $user->iva == "mt" ) {{$user->cuit}}@endif</div>
                       </div>
                    </div>
                    <div> 
                        <label><input type="checkbox" @if($user->iva == "cf") checked class="iva_active" @endif disabled> CF </label>
                        <div>
                             <p>Nro DNI</p> 
                             <div>@if($user->iva == "cf" ) {{$user->dni}}@endif</div>
                        </div>
                     </div>
                </div>
            </div>
            <div> 
                <p>Número telefónico</p> 
                <div>{{$user->phone}}</div>
            </div>
            <div> 
                <p>E-mail</p> 
                <div>{{$user->email}}</div>
            </div>
        </div>
        <div class="backButton">
            <a href="{{ url()->previous() }}" role="button">
                VOLVER
            </a>
        </div>
    </section>
@endsection
