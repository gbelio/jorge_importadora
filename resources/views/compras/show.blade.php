@extends('layouts.master')
@section('content')
<div>
    <section class="userOrders">
        <div><h3>MIS COMPRAS</h3></div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">N° Orden</th>
                    <th scope="col">Total</th>
                    <th scope="col">Creada</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td scope="row"><a href="/compras/detalle/{{$order->id}}">Orden n°{{$order->id}}</a></td>
                        <td>${{number_format($order->total, 2, ',', '.')}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>
                            @switch($order->status)
                                @case('pending')
                                    <b style="color:black;">Pendiente </b>
                                @break
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
@endsection
