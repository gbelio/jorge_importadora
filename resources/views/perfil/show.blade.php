@extends('layouts.master')
@section('content')
<div style="margin-top: 200px">
    <div>
        <div>
            <h3>DATOS</h3>
            <h3>Nombre: {{$profile->name}} {{$profile->last_name}}</h3>
            <h3>Email: {{$profile->email}}</h3>
            <h3>Teléfono: {{$profile->phone}}</h3>
            <h3>Comentario: {{$profile->comment}}</h3>
        </div>
        <div>
            <a href="{{ url()->previous() }}" role="button">
                VOLVER
            </a>
        </div>
    </div>
</div>
@endsection