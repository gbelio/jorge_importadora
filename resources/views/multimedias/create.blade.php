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
<main class="form-multimedia">
    <div class="container-multimedia">
        <div align="left" class="editor-multimedia">
            <h1 class="text-center __nuevasImagenes">Cargar nuevas imágenes</h1>
            <hr>
            <h4>Código de Producto: {{$producto->code}}</h4>
            <h2>{{$producto->name}}</h2>
            <h4> {{$producto->resume}}</h4>
            <form class="form-group __formulario" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group" style="display:none;">
                    <input type="text" name= "product_id" value="{{$producto->id}}">
                </div>            
                <div class="load-img">
                    <div class="form-group" style="margin:0 0 10px 0;">
                        <input class="__files" type="file" name="paths[]" multiple="multiple">
                    </div>
                    <div class="form-group _carga-multimedia">
                        <input type="submit" class="btn btn-primary btn-sm" value="Agregar Imagenes" id="addImage" style="font-family:'Raleway'; margin:0;">
                        <a href="/productos/cargar" class="btn btn-secondary btn-sm" role ="button" style="font-family:'Raleway'; margin:0 0 0 5px;">Volver</a>
                    </div>
                </div>
                <hr>
            </form>
            <div class="conjunto-imagenes">
                @foreach($multimedias as $multimedia)
                    @if($multimedia->product_id == $producto->id)
                        <div class="edicion-imagenes">
                            <div class="imagenes-cargadas">
                                <div class="img">     
                                    <img src="/storage/{{$multimedia->path}}" alt="">   
                                    <form method="POST" action="{{$multimedia->id}}" style="margin:0">
                                        @method('DELETE')
                                        @csrf
                                        <button class = "btn btn-danger __boton" type="submit" value="BORRAR REGISTRO">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection