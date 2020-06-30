@extends('layouts.master')
@section('content')

<div class="offset-3 col-6 form-categorias">
    <h1>Agregar Categoria</h1>
    <hr>
    <br>
    <form class="form-group" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="categoria">Categoria Nombre</label>
            <input type="text" name="name" value=" " class="form-control">
        </div>
        <br>
        <hr>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Agregar Categoria" id="addCategory">
        </div>
    </form>
</div>

@endsection