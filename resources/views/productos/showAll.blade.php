@extends('layouts.master')
@section('content')
<div class="caja-products-categories">
    <section class="products-all">{{-- 
        habría que hacer un foreach de categorias para listar y dentro de cada una un foreach de productos --}}
        @foreach ($categories as $category)
            <div class="category_prod">
                <h2>{{$category->name}}</h2>
            <div class="prods_">
                @foreach ($products as $product)
                    <article class="product_1">
                        <div class="product_1_img">
                            <span>{{$product->code}}</span>
                            <img class="product_1_img_imagen" src="/storage/{{$product->cover}}" alt="imagen de producto">
                            <a href="../productos/{{$product->id}}" target="blank">
                                    VER MÁS
                            </a>                        
                        </div>
                        <div class="prod_details">
                            <h3 class="prod_name" maxlength="25">{{$product->name}}</h3> {{-- revisar que no rompa si es mayor a 25 caracteres --}}
                            <div class="category_subcat">
                                <a href="#">{{$product->category_id}}</a>{{--  tiene que apuntar a todos los productos de esta categoria y traer el filtro de subcategoria --}}
                                <a href="#">{{$product->subcategory_id}}</a>  {{-- tiene que apuntar a todos los productos de esta categoria y subcategoria --}}
                            </div>
                            <p maxlength="60">{{$product->resume}}</p>
                        </div>
                    </article>
                @endforeach
                </div>
            </div>
            
        @endforeach
    </section>
</div>

@endsection