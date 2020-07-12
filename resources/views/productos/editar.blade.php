@extends('layouts.master')
@section('content')

<div class="" style="min-height:450px; margin-top:125px;">


    <div id="listaCategorias" class="offset-2 col-8 form-categorias">
        <div style="display:flex; flex-direction:row; justify-content:space-between">
            <h3 style="display:inline-block">Editar Producto</h3>
        </div>
        <br>
        <div style="display:flex; flex-direction:row; justify-content:center; align-items:center">
            <img style="width: 50%; height: 50%; " src="/storage/{{$producto->cover}}" alt="imagen de producto">
        </div>

        <form method="POST" action="" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            @csrf
            <div class="form-group">
                <label for="name" ><strong> Nombre </strong></label>
                <input name="name" value="{{$producto->name}}" type="text" class="form-control" placeholder="">
            </div>
            <div class="button" style="margin-bottom:6%;">
                <label for="name"><strong> Cover </strong></label>
                <input class="add_img" type="file" name="cover" value="{{$producto->cover}}">
            </div>
            <div class="form-group">
                <label for="description"><b> Descripción </b></label>
                <input name="description" value="{{$producto->description}}" type="text" class="form-control"
                    placeholder="">
            </div>
            <div class="form-group">
                <label for="category_id"><b> Categoría </b></label>
                <select class="form-control" name="category_id">
                    <option value="{{ $producto->category->id }}" selected>{{ $producto->category->name }}</option>
                    @isset($categorias)
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>
            <div class="form-group">
                <label for="category_id"><b> Categoría </b></label>
                <select class="form-control" name="subcategory_id">
                    @if($producto->subcategory_id !== null)
                        <option value="{{ $producto->subcategory->id }}" selected>{{ $producto->subcategory->name }}</option>
                    @endif
                    @foreach($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="d-flex md-form mt-0" style="justify-content:center">
                <a href="/productos/cargar" class="btn btn-info btn-sm boton-eliminar" role="button" style="margin:2%; background-color:#007BFF;border-color:#007BFF;">Volver</a>
                <input type="submit" class="btn btn-info btn-sm boton-eliminar" style="margin:2%; background-color:#007BFF;border-color:#007BFF;" value="Confirmar Cambios">
            </div>
        </form>
    </div>

</div>

@endsection