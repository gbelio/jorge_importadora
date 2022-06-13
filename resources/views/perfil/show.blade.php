@extends('layouts.master')
@section('content')
<div id="userProfile">
    <div>
        <div>
            <h3>DATOS DEL USUARIO</h3>
            <h3><b>Usuario:</b> {{$profile->name}} {{$profile->last_name}}</h3>
            <h3><b>Email:</b> {{$profile->email}}</h3>
            <h3><b>Teléfono:</b> {{$profile->phone}}</h3>
            <h3><b>Comentario:</b> {{$profile->comment}}</h3>
        </div>
        <div class="backButton">
            <a href="{{ url()->previous() }}" role="button">
                VOLVER
            </a>
        </div>
    </div>
</div>
@endsection