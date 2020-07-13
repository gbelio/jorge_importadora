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
            <div class="info_load">

                                <article class="product_1">
                                    <div class="product_1_img">
                                     
                                        <span>{{$producto->code}}</span>
                                        <img class="product_1_img_imagen" src="/storage/{{$producto->cover}}" alt="imagen de producto">
                                       <a href="/productos/{{$producto->id}}" target="blank">
                                                VER MÁS
                                        </a>                      
                                    </div>
                                    <div class="prod_details">
                                        <h3 class="prod_name" maxlength="25">{{$producto->name}}</h3> 
                                        <div class="category_subcat">
                                            <a href="#">{{$producto->category->name}}</a>
                                            <a href="#">{{$producto->subcategory->name}}</a>
                                        </div>
                                        <p maxlength="60">{{$producto->resume}}</p>
                                    
                                    </div>
                                </article>
                
        <div class="load_loaded"> 

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
                        <input type="submit" class="btn btn-primary btn-sm" value="Agregar Imagenes" id="addImage" style="font-family:'Raleway'; margin:0;width: 130px;">

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
            
        </div>
    </div>
</main>
@endsection