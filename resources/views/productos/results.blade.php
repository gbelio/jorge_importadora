@extends('layouts.master')
@section('content')
    <div class="caja-productos-resultados">
        <div class="caja-categorias-resultados">
            <div class="categoriaFiltro">
                <h3 class="searchMessage">
                    {{$mensaje}}
                </h3>
            </div>

            <section class="productos-categoria">
                @foreach ($products as $product)
                    <div class="cat-prod">
                        <article class="product_1">
                            <div class="product_1_img">
                                @if(Auth::user() != null)
                                    <div class="edit_prod">
                                        <a href="/productos/editar/{{$product->id}}">
                                            <img class="edit_button" alt="edit_button" src="/img/edit_button.svg">
                                        </a>
                                    </div>
                                    <div class="add_photos_prod">
                                        <a href="/productos/usuario/cargar_imagen/<?=$product->id?>">
                                            <i class="fa fa-file-image-o" style="font-size:15px; color: white"></i>
                                        </a>
                                    </div>
                                    <div class="delete_prod">
                                        <form id="_form_eliminar"
                                              action="{{action('ProductController@destroy', $product->id)}}"
                                              method="post">
                                            {{csrf_field()}}
                                            <input class="serdelete_val_id4" name="_method" type="hidden"
                                                   value="<?= $product->id ?>">
                                            <input class="serdelete_val_id5" name="_method" type="hidden"
                                                   value="<?= $product->name ?>">
                                            <button class="delete_button_showall" id="delete4"
                                                    data-id="<?= $product->id ?>" type="submit">
                                                <i class="fa fa-trash" style="font-size:16px"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                                <span>{{$product->code}}</span>
                                <img class="product_1_img_imagen" src="/storage/{{$product->cover}}"
                                     alt="imagen de producto">
                                <a href="../productos/{{$product->id}}" target="blank">VER MÁS</a>
                            </div>
                            <div class="prod_details">
                                <h3 class="prod_name" maxlength="25">{{$product->name}}</h3>
                                <div class="category_subcat">
                                    <a href="/categorias/busqueda?clave={{$product->category->name}}">{{$product->category->name}}</a>
                                    <a href="/subcategorias/busqueda?clave={{$product->subcategory->name}}">{{$product->subcategory->name}}</a>
                                </div>
                                <p maxlength="60">{{$product->resume}}</p>
                        </article>
                    </div>
                @endforeach
            </section>

            {{$products->links()}}

            {{--@if (count($products) == 0)--}}

                @if(count($categories) !== 0 || count($subcategory) !== 0)
                    <h3 class="offer_msg">Pero te puede llegar a interesar ...</h3>
                @endif

                <section style="width:100%">
                    @if ($categories !== null)
                        <section class="productos-perfil" style="width:100%">
                            @foreach ($allProducts as $product)
                                @foreach ($categories as $category)
                                    @if ($product->category_id == $category->id)
                                        <div class="cat-prod">
                                            <article class="product_1">
                                                <div class="product_1_img">
                                                    @if(Auth::user() != null)
                                                        <div class="edit_prod">
                                                            <a href="/productos/editar/{{$product->id}}">
                                                                <img class="edit_button" alt="edit_button"
                                                                     src="/img/edit_button.svg">
                                                            </a>
                                                        </div>
                                                        <div class="add_photos_prod">
                                                            <a href="/productos/usuario/cargar_imagen/<?=$product->id?>">
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
                                                                       type="hidden" value="<?= $product->id ?>">
                                                                <input class="serdelete_val_id5" name="_method"
                                                                       type="hidden" value="<?= $product->name ?>">
                                                                <button class="delete_button_showall" id="delete4"
                                                                        data-id="<?= $product->id ?>" type="submit">
                                                                    <i class="fa fa-trash" style="font-size:16px"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                    <span>{{$product->code}}</span>
                                                    <img class="product_1_img_imagen" src="/storage/{{$product->cover}}"
                                                         alt="imagen de producto">
                                                    <a href="../productos/{{$product->id}}" target="blank">VER MÁS</a>
                                                </div>
                                                <div class="prod_details">
                                                    <h3 class="prod_name" maxlength="25">{{$product->name}}</h3>
                                                    <div class="category_subcat">
                                                        <a href="/categorias/busqueda?clave={{$product->category->name}}">{{$product->category->name}}</a>
                                                        <a href="/subcategorias/busqueda?clave={{$product->subcategory->name}}">{{$product->subcategory->name}}</a>
                                                    </div>
                                                    <p maxlength="60">{{$product->resume}}</p>
                                            </article>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        </section>
                    @endif
                    @if ($subcategory !== null)
                        <section class="productos-perfil">
                            @foreach ($allProducts as $product)
                                @foreach ($subcategory as $subcat)
                                    @if ($product->subcategory_id == $subcat->id)
                                        <article class="product_1">
                                            <div class="product_1_img">
                                                @if(Auth::user() != null)
                                                    <div class="edit_prod">
                                                        <a href="/productos/editar/{{$product->id}}">
                                                            <img class="edit_button" alt="edit_button"
                                                                 src="/img/edit_button.svg">
                                                        </a>
                                                    </div>
                                                    <div class="add_photos_prod">
                                                        <a href="/productos/usuario/cargar_imagen/<?=$product->id?>">
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
                                                                   type="hidden" value="<?= $product->id ?>">
                                                            <input class="serdelete_val_id5" name="_method"
                                                                   type="hidden" value="<?= $product->name ?>">
                                                            <button class="delete_button_showall" id="delete4"
                                                                    data-id="<?= $product->id ?>" type="submit">
                                                                <i class="fa fa-trash" style="font-size:16px"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                                <span>{{$product->code}}</span>
                                                <img class="product_1_img_imagen" src="/storage/{{$product->cover}}"
                                                     alt="imagen de producto">
                                                <a href="../productos/{{$product->id}}" target="blank">VER MÁS</a>
                                            </div>
                                            <div class="prod_details">
                                                <h3 class="prod_name" maxlength="25">{{$product->name}}</h3>
                                                <div class="category_subcat">
                                                    <a href="/categorias/busqueda?clave={{$product->category->name}}">{{$product->category->name}}</a>
                                                    <a href="/subcategorias/busqueda?clave={{$product->subcategory->name}}">{{$product->subcategory->name}}</a>
                                                </div>
                                                <p maxlength="60">{{$product->resume}}</p>
                                        </article>
                                    @endif
                                @endforeach
                            @endforeach
                        </section>
                    @endif
                </section>
            {{--@endif--}}
        </div>
@endsection
