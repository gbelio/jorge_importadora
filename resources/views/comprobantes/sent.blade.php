@extends('layouts.master')
@section('content')
<div id="statusSection">
    <img src="/img/check-01.svg" alt="search">
    <h2>Su pedido fue realizado con éxito</h2>
    <a href="{{ url()->previous() }}" role="button">
        VOLVER
    </a>
</div>
@endsection
