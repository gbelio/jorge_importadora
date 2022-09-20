@extends('layouts.master')
@section('content')
    <div class="offset-2 col-8 form-categorias" style="min-height:450px;">
        <div id="listaCategorias">
            <div style="display:flex; flex-direction:row; justify-content:space-between">
                <h3 style="display:inline-block"> Agregar Categoría</h3>
                <button id="botonFormProd" style="font-size: 0px; background-color: white; color: black;" class="pull-right"><i class="fa fa-plus-square-o pull-right" style="font-size:30px; margin:0 !important"></i></button>
                <button id="botonFormProd1" style="font-size: 0px; background-color: white; color: black; display:none" class="pull-right"><i class="fa fa-minus-square-o" style="font-size:30px"></i></button>
            </div>
            <div id="target" style="display:none">
            <br>
            <form class="form-group" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="categoria">
                        <strong>Nombre</strong>
                    </label>
                    <input required type="text" name="name" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="categoria">
                        <strong>Apellido</strong>
                    </label>
                    <input required type="text" name="last_name" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="categoria">
                        <strong>Teléfono</strong>
                    </label>
                    <input required type="text" name="phone" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="categoria">
                        <strong>Email</strong>
                    </label>
                    <input required type="text" name="email" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="categoria">
                        <strong>Password</strong>
                    </label>
                    <input required type="text" name="phone" value="" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <input required type="submit" class="btn btn-primary btn-sm" value="Agregar Usuario" id="addCategory">
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
            <script src="{{asset('js/toggle.js')}}"></script>
@endsection
