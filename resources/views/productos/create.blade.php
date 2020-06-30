@extends('layouts.master')
@section('content')

@if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<br>
<section class="__formularioProd">
    <h1 class="text-center __createProd">Agregar Producto</h1>
    <form class="form-group __fuenteForm" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class=form-group style="display:none;">
            <input type="text" name= "user_id" value="{{Auth::user()->id}}">
        </div>
        <div class="form-group">
            <label for="producto">Nombre del producto</label>
            <input type="text" name="name" value="{{ old("name") }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción del producto</label>
            <input type="text" name="description" value="{{ old("description") }}" class="form-control" maxlength="190">
        </div>
        <div class="form-group">
            <label for="resume">Resumen del producto</label>
            <input type="text" name="resume" value="{{ old("resume") }}" class="form-control" maxlength="190">
        </div>
        <div class="form-group">
            <label for="code">Código</label>
            <input type="text" name="code" value="{{ old("code") }}" class="form-control" maxlength="190">
        </div>   
        <div class="form-group">
            <label for="genero">Categoría</label>
            <select class="form-control" name="category_id">
                <option value="" disabled selected>Seleccione la categoría correspondiente</option>
            @foreach($categorias as $categoria)
                @if ($categoria->id == old("category_id"))
                    <option value="{{ $categoria->id }}" selected>{{ $categoria->name }}</option>
                @else
                    <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                @endif
            @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="genero">Sub Categoría</label>
            <select class="form-control" name="subcategory_id">
                <option value="" disabled selected>Seleccione la sub categoría correspondiente</option>
            @foreach($subcategorias as $subcategoria)
                @if ($subcategoria->id == old("subcategory_id"))
                    <option value="{{ $subcategoria->id }}" selected>{{ $subcategoria->name }}</option>
                @else
                    <option value="{{ $subcategoria->id }}">{{ $subcategoria->name }}</option>
                @endif
            @endforeach
            </select>
        </div>
        <div class="button">
            <label for="poster" class="add_img">selecionar Imagen</label>
            <input class="avatar" type="file" name="cover">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary __agregarProd" value="Agregar Producto" id="addMovie">
        </div>
    </form>
</section>

@endsection