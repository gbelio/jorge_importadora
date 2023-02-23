@extends('layouts.master')
@section('content')

    {{-- SLIDER --}}
@if ($sliderstate > 0)
    @if($sliders_mobile)
            <div id="sliderHome" class="mt-100 d-md-none d-lg-none d-xl-none sliderHome_mobile">
                <div class="owl-carousel owl-theme">
                    @foreach ($sliders_mobile as $fila)
                        @if($fila->s_estado == 1)
                        <div class="slider">
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
                        @endif
                    @endforeach
                </div>
                <div class="slider_nav">
                    <a class="siguienteCarrousel"><i class='fa fa-angle-left' style="color: black; font-size:40px"></i></a>
                    <a class="anteriorCarrousel"><i class='fa fa-angle-right' style="color: black; font-size:40px"></i></a>
                </div>
            </div>
    @endif
@endif
@if ($sliderstate > 0)
    @if($sliders_desktop)
            <div id="sliderHome" class="mt-100 d-none d-md-block">
                <div class="owl-carousel owl-theme">
                    @foreach ($sliders_desktop as $fila)
                        @if($fila->s_estado == 1)
                        <div class="slider">
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
                        @endif
                    @endforeach
                </div>
                <div class="slider_nav">
                    <a class="siguienteCarrousel"><i class='fa fa-angle-left' style="color: black; font-size:40px"></i></a>
                    <a class="anteriorCarrousel"><i class='fa fa-angle-right' style="color: black; font-size:40px"></i></a>
                </div>
            </div>
    @endif
@endif
    {{-- SLIDER --}}

    <div class=@if($sliderstate > 0) "caja-products-categories-slide" @else "caja-products-categories" @endif style="flex-direction:column !important">
        <input type="hidden" id="categories-count" value="{{$allCategories->count()}}">
        <input type="hidden" name="categories_ids" id="categories_ids" value="{{$allCategories}}">
        @foreach ($allCategories as $category)
            <section class="{{-- products-all --}}" style="margin:0">
                @if (count($category->product) > 0 && $category->active_products > 0)
                    <div id="cat{{$category->id}}">
                        <a href="/categorias/busqueda?clave={{$category->name}}" class="cat-name"
                           style="text-decoration:none; color:#5FA8E5;">{{$category->name}}</a>

                        <div class="owl-carousel owl-theme">
                            @foreach($product_collections as $products)
                                @foreach ($products as $product)
                                    @if($product->active == 1)
                                        @if ($product->category->name == $category->name)
                                        <article class="product_1" style="margin-right:0px !important">
                                            <div class="product_1_img">
                                                @if(Auth::user() != null && Auth::user()->role === 9)
                                                    <div class="edit_prod">
                                                        <a href="/productos/editar/{{$product->id}}">
                                                            <img class="edit_button" alt="edit_button"
                                                                 src="/img/edit_button.svg">
                                                        </a>
                                                    </div>
                                                    <div class="add_photos_prod">
                                                        <a href="/productos/usuario/cargar_imagen/{{$product->id}}">
                                                            <i class="fa fa-file-image-o"
                                                               style="font-size:15px; color: white"></i>
                                                        </a>
                                                    </div>
                                                    <div class="delete_prod">
                                                        <form id="_form_eliminar"
                                                              action="{{action('ProductController@destroy', $product->id)}}"
                                                              method="post">
                                                            {{csrf_field()}}
                                                            <input class="serdelete_val_id4" name="_method"
                                                                   type="hidden" value="{{$product->id}}">
                                                            <input class="serdelete_val_id5" name="_method"
                                                                   type="hidden" value="{{$product->name}}">
                                                            <button class="delete_button_showall" id="delete4"
                                                                    data-id="{{$product->id}}" type="submit">
                                                                <i class="fa fa-trash" style="font-size:16px"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="deactivate_prod">
                                                        <form action="{{action('ProductController@deactivate', $product->id)}}" method="post">
                                                            {{csrf_field()}}
                                                            @method('PATCH')
                                                            <input type="hidden" name="active" value="{{$product->active == 1 ? 0 : 1}}">
                                                            <button id="deactivate" class="btn btn-sm" type="submit" style="width: fit-content ;margin:0 !important; color: white; {{$product->active == 1 ? 'background-color: red' : 'background-color: green'}}">
                                                                Desactivar
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                                <span>{{$product->code}}</span>
                                                <img class="product_1_img_imagen" src="/storage/{{$product->cover}}"
                                                     alt="imagen de producto">
                                                <a href="../productos/{{$product->id}}">VER MÁS</a>
                                            </div>
                                            <div class="prod_details">
                                                <h3 class="prod_name" maxlength="25">{{$product->name}}</h3>
                                                <div class="category_subcat">
                                                    <a href="/categorias/busqueda?clave={{$product->category->name}}">{{$product->category->name}}</a>
                                                    <a href="/subcategorias/busqueda?clave={{$product->subcategory->name}}">{{$product->subcategory->name}}</a>
                                                </div>
                                                <p maxlength="60">{{$product->resume}}</p>
                                                @Auth
                                                    @if($product->amount > 0)
                                                        <h5 class="amount">${{number_format($product->amount, 2, ',', '.')}}</h5>
                                                    @endif
                                                @endauth
                                            </div>
                                        </article>
                                    @endif
                                    @endif
                                @endforeach
                            @endforeach

                        </div>

                        <div class="slider_nav" style="display:none">
                            <a class="am-next{{$category->id}} d-none d-sm-block"><i class='fa fa-angle-left'
                                                                   style="color: black; font-size:40px"></i></a>
                            <a class="am-prev{{$category->id}} d-none d-sm-block"><i class='fa fa-angle-right'
                                                                   style="color: black; font-size:40px"></i></a>
                        </div>

                    </div>
                @endif
            </section>
        @endforeach
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/carousel.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
@endsection
