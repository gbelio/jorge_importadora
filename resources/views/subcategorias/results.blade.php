@extends('layouts.master')
@section('content')
<div class="caja-categorias-resultados">

    <div class="categoriaFiltro">
        <a class="cat-name" href="/categorias/busqueda?clave={{($subcategory[0]->category->name)}}" style="text-decoration:none;margin:0">{{($subcategory[0]->category->name)}} > </a>
        <h2 class="subcat-name">{{$subcategory[0]->name}}</h2>
    </div>

    <section class="productos-categoria">
        @foreach ($productsById as $product)
            @if($product->active == 1)
                <div class="cat-prod">
                    <article class="product_1">
                        <div class="product_1_img">
                            @if(Auth::user() != null && Auth::user()->role === 9)
                                <div class="edit_prod">
                                    <a href="/productos/editar/{{$product->id}}">
                                        <img class="edit_button" alt="edit_button" src="/img/edit_button.svg">
                                    </a>
                                </div>
                                <div class="add_photos_prod">
                                    <a href="/productos/usuario/cargar_imagen/{{$product->id}}">
                                        <i class="fa fa-file-image-o" style="font-size:15px; color: white"></i>
                                    </a>
                                </div>
                                <div class="delete_prod">
                                    <form id="_form_eliminar" action="{{action('ProductController@destroy', $product->id)}}" method="post">
                                        {{csrf_field()}}
                                        <input class="serdelete_val_id4" name="_method" type="hidden" value="{{$product->id}}">
                                        <input class="serdelete_val_id5" name="_method" type="hidden" value="{{$product->name}}">
                                        <button class="delete_button_showall" id="delete4" data-id="{{$product->id}}"  type="submit" >
                                            <i class="fa fa-trash" style="font-size:16px"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="deactivate_prod">
                                    <form action="{{action('ProductController@deactivate', $product->id)}}" method="post">
                                        {{csrf_field()}}
                                        @method('PATCH')
                                        <input type="hidden" name="active" value="{{$product->active == 1 ? 0 : 1}}">
                                        <button id="deactivate" class="btn btn-sm" type="submit" style="margin:0 !important; color: white; {{$product->active == 1 ? 'background-color: red' : 'background-color: green'}}">
                                            {{$product->active == 1 ? 'Off' : 'On'}}
                                        </button>
                                    </form>
                                </div>
                            @endif
                            <span>{{$product->code}}</span>
                            <img class="product_1_img_imagen" src="/storage/{{$product->cover}}" alt="imagen de producto">
                            <a href="../productos/{{$product->id}}" target="blank">VER MÁS</a>
                        </div>
                        <div class="prod_details_2">
                            <h3 class="prod_name" maxlength="25">{{$product->name}}</h3>
                            <div class="category_subcat">
                                <a href="/categorias/busqueda?clave={{$product->category->name}}">{{$product->category->name}}</a>
                                <a href="/subcategorias/busqueda?clave={{$product->subcategory->name}}">{{$product->subcategory->name}}</a>
                            </div>
                            <p maxlength="60">{{$product->resume}}</p>
                        </div>
                        <div class="price">
                                @Auth
                                    @if($product->amount > 0)
                                        <h5 class="amount_2">${{number_format($product->amount, 2, ',', '.')}}</h5>
                                    @endif
                                @endauth
                            </div>
                    </article>
                </div>
            @endif
        @endforeach
    </section>

    {{$productsById->links()}}
</div>
@endsection
