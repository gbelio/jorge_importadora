@extends('layouts.master')
@section('content')
<div class="" style="min-height:450px; margin-top:125px;">
    <div id="listaCategorias" class="offset-2 col-8 form-categorias">
        <div style="display:flex; flex-direction:row; justify-content:space-between">
            <h3 style="display:inline-block">Editar Subcategoría</h3>
        </div>
        <form action="{{action('SubcategoryController@update', $subcategoria->id)}}" method="post">
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
                <a id="boton_volver" href="/subcategorias/cargar" class="btn btn-info btn-sm" role="button">Volver</a>
                <input id="boton_confirmar" type="submit" class="btn btn-info btn-sm" value="Confirmar Cambios">
            </div>
        </form>
    </div>
</div>
@endsection