@extends('layouts.master')
@section('content')
<div class="caja-productos-categoria">
    <section class="productos-perfil">
        @foreach ($products as $product)
            <article class="producto-individual">
                <div class="producto">
                    <img class="imagen-producto" src="/storage/{{$product->cover}}" alt="imagen de producto">
                </div>
                <div class="info" style="margin-top:3%">
                    <h4 class="nombre-producto"> {{$product->name}} </h4>
                    <div class="categorias">
                        <h5 class="nombre-categoria"> {{$product->category->name}}</h5>
                        @if($product->subcategory_id != null)
                            <h5 class="nombre-subcategoria"> | {{$product->subcategory->name}} </h5>
                        @endif
                    </div>
                </div>
                <div class="edicion">
                    @if(Auth::user() != null)
                    <a href="/productos/editar/{{$product->id}}">
                        <h5 class="ver-fotos">Editar</h5>
                    </a>
                    @endif
                    <a href="../productos/{{$product->id}}">
                        <h5 class="ver-fotos">VER</h5>
                    </a>
                </div>
            </article>
        @endforeach
    </section>
</div>

@endsection