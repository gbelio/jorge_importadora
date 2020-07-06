@extends('layouts.master')
@section('content')

<div>

    <section class="prod_1">

        <div class="prod_1_cat">
            <a class="cat" href="#" target="blank">{{$producto->category->name}} > </a>
            <a class="subcat" href="#" target="blank"> {{$producto->subcategory->name}}</a>
        </div>
        <div class="prod_box">
            <div class="prod_box_imgs" id="prod_box_img">

                <div id="imagen-principal"> 
                    <img class="imagen-principal" id="box_ppal" alt="destacada" src="/storage/{{$producto->cover}}"> 
                </div>
                
                <div id="muestra_galeria"> 
                    <img class="img_gallery" id="galery" src="/storage/{{$producto->cover}}">
                    @foreach($multimedias as $multimedia)
                                @if($multimedia->product_id !== null)
                                    @if ($producto->id == $multimedia->product_id)
                                        <img class="img_gallery" id="galery" alt="galeria" src="/storage/{{$multimedia->path}}">
                                    @endif
                                @endif
                    @endforeach
                </div>
                
                
            </div>

            <div class="prod_box_details">
                texto
            <div>  

        </div>    

    </section>
   {{--  <section class="">
        <article class="producto-perfil">
            <div class="producto">
                <img class="imagen-producto" src="/storage/{{$producto->cover}}" style="border-radius:3px;" alt="imagen de producto">
            </div>
            <div class="info" style="margin-top:0%">
                <h4 class="nombre-producto"> {{$producto->name}} </h4>
                <div class="categorias">
                <h5 class="nombre-categoria"> {{$producto->category->name}}</h5>
                @if($producto->subcategory_id != null)
                    <h5 class="nombre-subcategoria"> | {{$producto->subcategory->name}} </h5>
                @endif
                </div>
                <h6 class="descripcion-producto"> {{$producto->description}} </h6>
            </div>
                <div class="edicion">
                @if(Auth::user() != null)
                    <a href="/productos/editar/{{$producto->id}}">
                        <h5 class="ver-fotos">Editar</h5>
                    </a>
                @endif        
                <a href="#">           
                <h5 class="ver-fotos"  id="abrir" style="color:red;">VER FOTOS</h5>
                </a>
                <div id="miModal" class="modalito">
                    <div id="flex" class="flex">
                        <div class="contenido_modal">
                            <span id="close" class="close"></span>
                            @foreach($multimedias as $multimedia)
                                @if($multimedia->product_id !== null)
                                    @if ($producto->id == $multimedia->product_id)
                                    <img class="mySlides" src=" /storage/{{$multimedia->path}}" alt="">
                                    @endif
                                @endif
                            @endforeach
                            <button class="w3-button w3-light-grey  w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
                            <button class="w3-button w3-light-grey  w3-display-right" onclick="plusDivs(+1)">&#10095;</button>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section> --}}
</div>

@endsection