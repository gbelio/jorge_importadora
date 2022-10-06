@extends('layouts.master')
@section('content')
<div>
    {{---------------------- ****************BARRA DE BUSQUEDA**************** ----------------------------}}
    <div class="col-12 searchBar">
        <form action="/compras/busqueda" class="offset-1" method="get" style="">
            @csrf
            <input required placeholder='email' type="text" name="clave">
            <button type="submit" value="" class="btn btn-success" name="" id="">
                BUSCAR
            </button>
        </form>
    </div>
    @isset($response)
        <span class="offset-1" style="color: red"><b>{{$response}}</b></span>
        <br>
        <i class="offset-1">ingrese el mail completo para mejorar la busqueda...</i>
        <br>
    @endisset
    <br>
    {{---------------------- ****************LISTA COMPRAS**************** ----------------------------}}
    <section class="orderTable" style="overflow: scroll;">
        <div><h3>LISTA DE COMPRAS</h3></div>
        <table id="mytable" class="table table-striped">
            <thead>
                <th class="text-center">Id</th>
                <th class="text-center">Usuario</th>
                <th class="text-center">Última modificación</th>
                <th class="text-center">Total</th>
                <th class="text-center">Estado</th>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td data-title="N° Compra" class="text-center"><a href="/compras/detalle/{{$order->id}}">{{$order->id}}</a></td>
                        <td data-title="Email" class="text-center"><a href="/perfil/{{$order->user->id}}">{{$order->user->email}}</a></td>
                        <td data-title="Última modificación" class="text-center">{{$order->updated_at}}</td>
                        <td data-title="Total" class="text-center">${{$order->total}}</td>
                        <td data-title="Cambiar de estado" class="text-center">
                            <form id="" action="{{action('OrderController@updateStatus')}}" method="POST">
                                {{ method_field('PATCH') }}
                                @csrf
                                @php
                                    $color = "";
                                    switch($order->status){
                                        case('pending'):
                                           $color="black";
                                           break;
                                        case('preparing'):
                                           $color="orange";
                                           break;
                                       case('ready'):
                                           $color= "blue";
                                           break;
                                       case('finish'):
                                           $color= "green";
                                           break;
                                       case('cancelled'):
                                           $color= "red";
                                           break;
                                    }
                                @endphp
                                <select class="form-select" aria-label="Default select example" style="display: inline-block; margin-top: -22px; margin-left: 5px; color:{{$color}}" name="status" id="status" onchange="this.form.submit()">
                                    @switch($order->status)
                                        @case('pending')
                                            <option style="color:black;">Pendiente </option>
                                            @break
                                        @case('preparing')
                                            <option style="color:orange;">Preparando </option>
                                            @break
                                        @case('ready')
                                            <option style="color:blue;">Listo!</option>
                                            @break
                                        @case('finish')
                                            <option style="color:green;">Finalizado</option>
                                            @break
                                        @case('cancelled')
                                            <option style="color:red;">Cancelado</option>
                                            @break
                                    @endswitch
                                    @if($order->status !== 'pending')<option value="6" style="color:black;">Pendiente </option> @endif
                                    @if($order->status !== 'preparing')<option value="2" style="color:orange;">Preparando</option> @endif
                                    @if($order->status !== 'ready')<option value="3" style="color:blue;">Listo!</option> @endif
                                    @if($order->status !== 'finish')<option value="4" style="color:green;">Finalizado</option> @endif
                                    @if($order->status !== 'cancelled')<option value="5" style="color:red;">Cancelado</option> @endif
                                </select>
                                <input type="hidden" name="id" value="{{$order->id}}">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{$orders->links()}}
        </div>
    </section>
</div>
@endsection
