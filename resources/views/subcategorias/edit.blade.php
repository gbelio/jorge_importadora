@extends('layouts.master')
@section('content')

<div class="" style="min-height:450px; margin-top:125px;">

    <div id="listaCategorias" class="offset-2 col-8 form-categorias">
        <div style="display:flex; flex-direction:row; justify-content:space-between">
            <h3 style="display:inline-block">Editar Subcategoría</h3>
        </div>

        <form action="{{action('CategoryController@update', $subcategoria->id)}}" method="post">
            <br>
            @csrf
            {{ method_field('PATCH') }}
            <div class="form-group">
                <label for="name"><strong> Nombre </strong></label>
                <input required name="name" value="{{$subcategoria->name}}" type="text" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label for="name"><strong> Categoría a la que pertenece </strong></label>

                <select class="form-control" name="category_id">
                    @isset($categorias)
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                        @endforeach
                    @endisset
                </select>

            </div>
            
            
            <br>
            <div>
                <a href="/subcategorias/cargar" class="btn btn-info btn-sm boton-eliminar" role="button" style="margin:2% 0%; background-color:#007BFF;border-color:#007BFF;">Volver</a>
                <input type="submit" class="btn btn-info btn-sm boton-eliminar" style="margin:2% 0%; background-color:#007BFF;border-color:#007BFF;" value="Confirmar Cambios">
            </div>
        </form>

       
    </div>

</div>

@endsection