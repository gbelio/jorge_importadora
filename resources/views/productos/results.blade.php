@extends('layouts.master')
@section('content')
<div class="caja-productos-categoria">
    <h3><em>{{$mensaje}}</em></h3>
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
    @if (count($products) == 0)
    <h3><em>Pero te puede llegar a interesar ...</em></h3>
        <section>
            @if ($categories !== null)
                <section class="productos-perfil">
                    @foreach ($allProducts as $product)
                        @foreach ($categories as $category)
                            @if ($product->category_id == $category->id)
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
                                        <a href="../productos/{{$product->id}}">
                                            <h5 class="ver-fotos">VER</h5>
                                        </a>
                                    </div>
                                </article>
                            @endif
                        @endforeach
                    @endforeach
                </section>    
            @endif
            @if ($subcategories !== null)
                <section class="productos-perfil">
                    @foreach ($allProducts as $product)
                        @foreach ($subcategories as $subcategory)
                            @if ($product->subcategory_id == $subcategory->id)
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
                                        <a href="../productos/{{$product->id}}">
                                            <h5 class="ver-fotos">VER</h5>
                                        </a>
                                    </div>
                                </article>
                            @endif
                        @endforeach
                    @endforeach
                </section>    
            @endif
        </section>
    @endif
</div>
@endsection