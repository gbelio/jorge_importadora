@extends('layouts.master')
@section('content')
<div class="caja-categorias-resultados">
    <div class="categoriaFiltro">
    <h2 class="cat-name">Categoría ></h2>
    <h2 class="subcat-name">{{$subcategory[0]->name}}</h2>
    </div>
    <section class="productos-categoria">
        @foreach ($productsById as $product)
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
                    <form id="_form_eliminar" action="{{action('ProductController@destroy', $product->id)}}" method="post">
                        {{csrf_field()}}
                        <input class="serdelete_val_id4" name="_method" type="hidden" value="<?= $product->id ?>">
                        <input class="serdelete_val_id5" name="_method" type="hidden" value="<?= $product->name ?>">
                        <button class="delete_button_showall" id="delete4" data-id="<?= $product->id ?>"  type="submit" >
                            <i class="fa fa-trash" style="font-size:16px"></i>
                        </button>
                    </form>
                </div>
                @endif
                <span>{{$product->code}}</span>
                <img class="product_1_img_imagen" src="/storage/{{$product->cover}}" alt="imagen de producto">
                <a href="../productos/{{$product->id}}" target="blank">VER MÁS</a>
            </div>
            <div class="prod_details">
                <h3 class="prod_name" maxlength="25">{{$product->name}}</h3> {{-- revisar que no rompa si es mayor a 25 caracteres --}}
                <div class="category_subcat">
                    <a href="#">{{$product->category->name}}</a>{{--  tiene que apuntar a todos los productos de esta categoria y traer el filtro de subcategoria --}}
                    <a href="#">{{$product->subcategory->name}}</a>{{-- tiene que apuntar a todos los productos de esta categoria y subcategoria --}}
                </div>
                <p maxlength="60">{{$product->resume}}</p>
            </div>
        </article>
    </div>
        
        @endforeach
    </section>
</div>
@endsection