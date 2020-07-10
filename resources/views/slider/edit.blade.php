@extends('layouts.master')
@section('content')

<div class="" style="min-height:450px; margin-top:125px;">

    <div id="listaCategorias" class="offset-2 col-8 form-categorias">
        <div style="display:flex; flex-direction:row; justify-content:space-between">
            <h3 style="display:inline-block">Editar Slider</h3>
        </div>

        <form action="{{action('SliderController@update', $slider->id)}}" method="post">
            <br>
            @csrf
            {{ method_field('PATCH') }}
            <div class="form-group">
                <label for="s_estado"> Estado </label>
                <br>

                <input type="radio" name="s_estado" value="1">
                <label for="s_estado">Activado</label><br>
                <input type="radio" name="s_estado" value="0">
                <label for="s_estado">Desactivado</label><br>

            </div>

            <div class="form-group">
                <label for="s_link">Redirección</label>
                <input name="s_link" value="{{$slider->s_link}}" type="text" class="form-control" placeholder="">
            </div>
            
    
            <div>
                <a href="/slider/cargar" class="btn btn-info btn-sm boton-eliminar" role="button" style="margin:2% 0%; background-color:#007BFF;border-color:#007BFF;">Volver</a>
                <input type="submit" class="btn btn-info btn-sm boton-eliminar" style="margin:2% 0%; background-color:#007BFF;border-color:#007BFF;" value="Confirmar Cambios">
            </div>
        </form>

     </div>
</div>

@endsection