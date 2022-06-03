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
    @endisset
    {{---------------------- ****************LISTA COMPRAS**************** ----------------------------}}
    <section class="orderTable">
        <div><h3>LISTA DE COMPRAS</h3></div>
        <table id="mytable" class="table table-striped">
            <thead>
                <th class="text-center">Id</th>
                <th class="text-center">Usuario</th>
                <th class="text-center">Creado</th>
                <th class="text-center">Actualizado</th>
                <th class="text-center">Total</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Cambiar de estado</th>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td data-title="N° Compra" class="text-center"><a href="/compras/detalle/{{$order->id}}">{{$order->id}}</a></td>
                        <td data-title="Email" class="text-center"><a href="/perfil/{{$order->user->id}}">{{$order->user->email}}</a></td>
                        <td data-title="Fecha compra" class="text-center">{{$order->created_at}}</td>
                        <td data-title="Actualizado" class="text-center">{{$order->updated_at}}</td>
                        <td data-title="Total" class="text-center">${{$order->total}}</td>
                        <td data-title="Estado" class="text-center">
                            @switch($order->status)
                                @case('preparing')
                                    <b style="color:orange;">Preparando</b>
                                    @break
                                @case('ready')
                                    <b style="color:blue;">Listo!</b>
                                    @break
                                @case('finish')
                                    <b style="color:green;">Finalizado</b>
                                    @break
                                @case('cancelled')
                                    <b style="color:red;">Cancelado</b>
                                    @break
                            @endswitch
                        </td>
                        <td data-title="Cambiar de estado" class="text-center">
                            <form id="" action="{{action('OrderController@updateStatus')}}" method="POST">
                                {{ method_field('PATCH') }}
                                @csrf
                                <select class="form-select" aria-label="Default select example" style="display: inline-block; margin-top: -22px; margin-left: 5px;" name="status" id="status" onchange="this.form.submit()">
                                    <option></option>
                                    <option value="2">Preparando</option>
                                    <option value="3">Listo!</option>
                                    <option value="4">Finalizado</option>
                                    <option value="5">Cancelado</option>
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
