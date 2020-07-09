@extends('layouts.master')
@section('content')
@if (count($sliders) > 0)
    <div id="sliderHome" class="mt-100">
        <div class="owl-carousel owl-theme">
            @foreach ($sliders as $fila)   
<div class="slider" {{-- style="max-height:360px !important" --}}>
                    @if (empty($fila->s_link))
                        <img src="/storage/{{$fila->s_img}}" class="img-responsive">
                        @else
                        <a href="{{$fila->s_link}}" target="__blank">
                            <img src="/storage/{{$fila->s_img}}" class="img-responsive">
                        </a>
                        <div class="carousel-caption">
                            <h3></h3>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="slider_nav">
            <a class="siguienteCarrousel"><i class='fa fa-angle-left' style="color: black; font-size:40px"></i></a>
            <a class="anteriorCarrousel"><i class='fa fa-angle-right'style="color: black; font-size:40px"></i></a>
        </div>
    </div>
@endif
<div class="caja-products-categories" style="flex-direction:column !important">
    @foreach ($categories as $category)
        <section class="{{-- products-all --}}" style="margin:0">
                @if (count($category->product) > 0)
                    <div id="cat{{$category->id}}">
                        <h2>{{$category->name}}</h2>

                        <div class="{{-- prods_ --}}owl-carousel owl-theme">
                            @foreach ($products as $product)
                                @if ($product->category->name == $category->name)
                                    <article class="product_1" style="margin-right:0px !important">
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
                                                <a href="#">{{$product->category->name}}</a>{{--  tiene que apuntar a todos los productos de esta categoria y traer el filtro de subcategoria --}}
                                                <a href="#">{{$product->subcategory->name}}</a>{{-- tiene que apuntar a todos los productos de esta categoria y subcategoria --}}
                                            </div>
                                            <p maxlength="60">{{$product->resume}}</p>
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
                                        </div>
                                    </article>
                                @endif
                            @endforeach
                        </div>
                        <div class="slider_nav">
                            <a class="am-next{{$category->id}}"><i class='fa fa-angle-left' style="color: black; font-size:40px"></i></a>
                            <a class="am-prev{{$category->id}}"><i class='fa fa-angle-right'style="color: black; font-size:40px"></i></a>
                        </div>
                    </div>
                @endif
        </section>
    @endforeach
</div>
@endsection