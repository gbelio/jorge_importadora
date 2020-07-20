@extends('layouts.master')
@section('content')
<div>
    <section class="prod_1">
        <div class="prod_1_cat">
            <a class="cat" href="#">{{$producto->category->name}}></a>
            <a class="subcat" href="#"> {{$producto->subcategory->name}}</a>
        </div>
        <div class="prod_box">
            <div class="prod_box_imgs" id="prod_box_img">
                <div id="imagen-principal">
                    <img class="imagen-principal" id="box_ppal" alt="destacada" src="/storage/{{$producto->cover}}"> 
                </div>
                <div id="muestra_galeria">
                    <img class="img_gallery" id="galery" src="/storage/{{$producto->cover}}">
                    @foreach($multimedias as $multimedia)
                                @if($multimedia->product_id !== null)
                                    @if ($producto->id == $multimedia->product_id)
                                        <img class="img_gallery" id="galery" alt="galeria" src="/storage/{{$multimedia->path}}">
                                    @endif
                                @endif
                    @endforeach
                </div>
            </div>

            <div class="prod_box_details">

                <div> 
                    @if(Auth::user() != null)
                        <div class="_codigo_botones">
                            <div style="margin-bottom: 0px !important">
                                <h4>Código de Producto: {{$producto->code}}</h4>
                            </div>
                            <div class="_contenedorBotones">
                                <div class="edit_prod_show">
                                    <a href="/productos/editar/{{$producto->id}}">
                                        <img class="edit_button" alt="edit_button" src="/img/edit_button.svg">
                                    </a>
                                </div>
                                <div class="add_photos_prod_show">
                                    <a href="/productos/usuario/cargar_imagen/<?=$producto->id?>">
                                        <i class="fa fa-file-image-o" style="font-size:15px; color: white; margin-top:5px;"></i>
                                    </a>
                                </div>
                                <div class="delete_prod_show">
                                    <form id="_form_eliminar" action="{{action('ProductController@destroy', $producto->id)}}" method="post">
                                        {{csrf_field()}}
                                        <input class="serdelete_val_id4" name="_method" type="hidden" value="<?= $producto->id ?>">
                                        <input class="serdelete_val_id5" name="_method" type="hidden" value="<?= $producto->name ?>">
                                        <button class="delete_button_showall" id="delete4" data-id="<?= $producto->id ?>"  type="submit" >
                                            <i class="fa fa-trash" style="font-size:16px"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                    <div>
                        <h4>Código de Producto: {{$producto->code}}</h4>
                    </div>
                    @endif


                    <h2>{{$producto->name}}</h2>
                    <p> {{$producto->resume}}</p>
                </div>
                <p class="p-description">{{$producto->description}}</p>
             </div>    

    </section>
</div>

@endsection