@extends('layouts.master')
@section('content')

<div class="caja-productos-categoria">
    <h1 class="titulo-categoria" style="text-align: center;">{{$categoria->name}}</h1>        
    <section class="productos-perfil">
        @foreach ($productos as $producto)
            @if($categoria->id == $producto->category_id)       
                <article class="producto-individual">
                    <div class="producto">
                        <img class="imagen-producto" src="/storage/{{$producto->cover}}" alt="imagen de producto">
                    </div>
                    @if(Auth::user() == null)
                        <div class="boton" style="margin-bottom:-6%">
                            <a href="#"><img class="solicitar" src="/img/solicitar_-01.svg" alt="solicitar"></a>
                        </div>
                    @elseif(Auth::user()->id != $producto->user_id)
                        <div class="boton" style="margin-bottom:-6%">
                            <a href="#"><img class="solicitar" src="/img/solicitar_-01.svg" alt="solicitar"></a>
                        </div>
                    @endif
                    <div class="info" style="margin-top:3%">
                        <h4 class="nombre-producto"> {{$producto->name}} </h4>
                        <div class="categorias">
                            <h5 class="nombre-categoria"> {{$producto->categoria->name}}</h5>
                            @if($producto->subcategory_id != null)
                                <h5 class="nombre-subcategoria"> | {{$producto->subcategoria->name}} </h5>
                            @endif
                        </div>
                    </div>
                    <div class="edicion">
                    <a href="../productos/{{$producto->id}}">
                        <h5 class="ver-fotos">VER</h5>
                    </a>
                    </div>
                    <div class="edicion">
                        <a href="../profile/{{$producto->user_id}}">
                            <h5 class="ver-fotos">Ver Usuario</h5>
                        </a>
                    </div>
                </article>
            @endif
        @endforeach
    </section>
    {{$productos->links()}}
</div>

@endsection