@extends('layouts.master')
@section('content')

<div class="offset-3 col-6 form-subcategorias">
    <h1 align="center">Agregar Sub Categoria</h1>
    <hr>
    <br>
    <form class="form-group" action="" method="post">
        @csrf
        <div class="form-group">
            <label for="categoria">Nombre Sub Categoria</label>
            <input type="text" name="name" value=" " class="form-control">
        </div>
        <div class="form-group">
            <label for="categoria">En la categoría :</label>
            <select class="form-control" name="category_id">
                <option value="" disabled selected><b> Seleccione Categoría </b></option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                @endforeach
        </div>        
        <br>
        <br>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Agregar Sub Categoria" id="addSubCategory">
        </div>
    </form>
</div>
@endsection