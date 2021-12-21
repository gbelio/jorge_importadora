@extends('layouts.master')
@section('content')
    <h2 style="margin-top:200px">Su pedido fue realizado con éxito</h2>
        <a href="{{ url()->previous() }}" role="button">
            VOLVER
        </a>
</div>
@endsection
