@extends('layouts.master')
@section('content')
<section class="user">
    <article class="user-content">
        <div class="user-avatar">
        <img src="{{url('/storage/avatars/'. $user->avatar)}}" alt="foto usuario">
        </div>
        <div class="user-details">
            <h1>{{$user->name}}</h1>
            <p class="user-motto" contenteditable="true">"Insertar frase chistosa"</p>
            <div class="data">
                <ul class="icons">
                <li><img src="{{asset("img/admiration_marc-01.svg")}}" alt=""></li>
                    <li>Mensajes</li>
                    <li><a href="/productos/cargar" style="color:yellow;">Agregar producto</a></li>                
                </ul>       
                <ul class="details">
                    <li>Ofertas 102</li>
                    <li>Demandas 185</li>
                    <li>Intercambios 88</li>
                    <li>Compras 2</li>
                    <li>Ventas 0</li>
                </ul>
            </div>
        </div>
    </article>
</section>
<section class="caja-productos">    
    <article class="productos-perfil">
        @isset($productos)      
            @foreach($productos as $producto)
                @if($producto->user_id == Auth::user()->id)        
                    <div class="producto-individual">
                        <div class="producto">
                            <img class="imagen-producto" src="{{asset('/storage/'. $producto->cover)}}" style="border-radius:3px;" alt="imagen de producto">
                        </div>
                        @if($producto->user_id == Auth::user()->id)
                            <div class="boton" style="display:none">
                                <a href="#"><img class="solicitar" src="/img/solicitar_-01.svg" alt="solicitar"></a>
                            </div>    
                            <div class="info" style="margin-top:0%">
                                <h4 class="nombre-producto"> {{$producto->name}} </h4>
                                <div class="categorias">
                                    <h5 class="nombre-categoria"> {{$producto->categoria->name}}</h5>
                                    @if($producto->subcategory_id != null)
                                        <h5 class="nombre-subcategoria"> | {{$producto->subcategoria->name}} </h5>
                                    @endif
                                </div>            
                            </div>
                        @endif
                        <div class="edicion">
                            <a href="/productos/{{$producto->id}} ">
                                <h5 class="ver-fotos" style="color:red;">VER MÁS!</h5>
                            </a>                        
                            <a href="productos/editar/{{$producto->id}}" id="abrir">
                                <h5 class="ver-fotos">EDITAR</h5>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        @endisset
    </article>
</section>
@endsection