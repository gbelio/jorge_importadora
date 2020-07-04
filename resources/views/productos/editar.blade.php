@extends('layouts.master')
@section('content')

<div class="producto-editar" style="display:flex; justify-content:center;">
    <div align="left" class="producto-individual __editar-prod" style="padding-bottom:2%">
        <br>
        <h1 align="center" class="__nuevasImagenes">Editar Producto</h1>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <div class="producto __editar-img">
            <img class="imagen-producto" src="/storage/{{$producto->cover}}" alt="imagen de producto">
        </div>
        <form method="POST" action="" style="padding:1em" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            @csrf
            <div class="form-group">
                <label for="name" class="nombre-producto"> Nombre </label>
                <input name="name" value="{{$producto->name}}" type="text" class="form-control" placeholder="">
            </div>
            <div class="button" style="margin-bottom:6%;">
                <label for="name" class="nombre-categoria"> Cover </label>
                <input class="add_img" type="file" name="cover" value="{{$producto->cover}}">
            </div>
            <div class="form-group">
                <label for="description" class="nombre-categoria"><b> Descripción </b></label>
                <input name="description" value="{{$producto->description}}" type="text" class="form-control"
                    placeholder="">
            </div>
            <div class="form-group">
                <label for="category_id" class="nombre-categoria"><b> Categoría </b></label>
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
                <label for="category_id" class="nombre-categoria"><b> Categoría </b></label>
                <select class="form-control" name="subcategory_id">
                    @if($producto->subcategory_id !== null)
                        <option value="{{ $producto->subcategory->id }}" selected>{{ $producto->subcategory->name }}</option>
                    @endif
                    @foreach($subcategorias as $subcategoria)
                        <option value="{{ $subcategoria->id }}">{{ $subcategoria->name }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="d-flex md-form mt-0" style="justify-content:center">
                <a href="/productos" class="btn btn-info btn-sm boton-eliminar" role="button" style="margin:2%; background-color:#007BFF;border-color:#007BFF;">Volver</a>
                <input type="submit" class="btn btn-info btn-sm boton-eliminar" style="margin:2%; background-color:#007BFF;border-color:#007BFF;" value="Confirmar Cambios">
            </div>
        </form>
        <form method="POST" action="{{$producto->id}}">
            {{method_field('DELETE')}}
            @csrf
            <button class="btn btn-danger btn-sm boton-eliminar" type="submit" value="" style="display:inherit; margin:0 auto">
                Eliminar Producto
            </button>
        </form>
     </div>
</div>

@endsection