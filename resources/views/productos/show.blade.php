@extends('layouts.master')
@section('content')
<div>
    <section class="prod_1">
        <div class="prod_1_cat">
            <a class="cat" href="#" target="blank">{{$producto->category->name}}></a>
            <a class="subcat" href="#" target="blank"> {{$producto->subcategory->name}}</a>
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
                    <h4>Código de Producto: {{$producto->code}}</h4>
                    <h2>{{$producto->name}}</h2>
                    <p> {{$producto->resume}}</p>
                </div>
                <p>{{$producto->description}}</p>
            </div>
    </section>
</div>
@endsection