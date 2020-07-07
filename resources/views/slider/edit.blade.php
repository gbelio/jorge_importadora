@extends('layouts.master')
@section('content')

<div class="producto-editar" style="display:flex; justify-content:center;">
    <div align="left" class="producto-individual __editar-prod" style="padding-bottom:2%">
        <br>
        <h1 align="center" class="__nuevasImagenes">Editar Slider</h1>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <form action="{{action('SliderController@update', $slider->id)}}" method="post">
            @csrf
            {{ method_field('PATCH') }}
            <div class="form-group">
                <label for="s_estado" class="nombre-producto"> Estado </label>
                <input name="s_estado" value="{{$slider->s_estado}}" type="text" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label for="s_link" class="nombre-producto"> Redirección</label>
                <input name="s_link" value="{{$slider->s_link}}" type="text" class="form-control" placeholder="">
            </div>
            
            
            <br>
            <div class="d-flex md-form mt-0" style="justify-content:center">
                <a href="/slider/cargar" class="btn btn-info btn-sm boton-eliminar" role="button" style="margin:2%; background-color:#007BFF;border-color:#007BFF;">Volver</a>
                <input type="submit" class="btn btn-info btn-sm boton-eliminar" style="margin:2%; background-color:#007BFF;border-color:#007BFF;" value="Confirmar Cambios">
            </div>
        </form>

     </div>
</div>

@endsection