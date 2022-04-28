@extends('layouts.master')
@section('content')
<div class="" style="min-height:450px; margin-top:125px;">
    <div id="listaCategorias" class="offset-2 col-8 form-categorias">
        <div style="display:flex; flex-direction:row; justify-content:space-between">
            <h3 style="display:inline-block">Editar Color</h3>
        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <br>
        <form action="{{action('ColourController@update', $color->id)}}" method="post">
            @csrf
            {{ method_field('PATCH') }}
            <div class="form-group">
                <label for="name" class=""><strong> Nombre </strong></label>
                <input name="name" value="{{$color->name}}" type="text" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label for="hex" class=""><strong>Código hexadecimal</strong></label>
                <input name="hex" value="{{$color->hex}}" type="text" class="form-control" placeholder="">
            </div>
            <br>
            <div>
                <a href="/colores/cargar" class="btn btn-info btn-sm" role="button" style="margin:2% 0%; background-color:#007BFF;border-color:#007BFF;">Volver</a>
                <input type="submit" class="btn btn-info btn-sm" style="margin:2% 0%; background-color:#007BFF;border-color:#007BFF;" value="Confirmar Cambios">
            </div>
        </form>
    </div>
</div>
@endsection
