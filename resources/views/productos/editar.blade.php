@extends('layouts.master')
@section('content')
<div class="" style="min-height:450px; margin-top:125px;">
    <div id="listaCategorias" class="offset-2 col-8 form-categorias">
        <div style="display:flex; flex-direction:row; justify-content:space-between">
            <h3 style="display:inline-block">Editar Producto</h3>
        </div>
        <br>
        <div style="display:flex; flex-direction:row; justify-content:center; align-items:center">
            <img style="max-width: 500px; max-height: 500px; " src="/storage/{{$producto->cover}}" alt="imagen de producto">
        </div>
        <form method="POST" action="" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            @csrf
            <div class="form-group">
                <label for="code"><strong>Código</strong></label>
                <input required type="text" maxlength="25" name="code" value="{{$producto->code}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="name" ><strong> Nombre </strong></label>
                <input name="name" maxlength="25" value="{{$producto->name}}" type="text" class="form-control" placeholder="">
            </div>
            <div class="button" style="margin-bottom:1%;">
                <label for="name"><strong> Cover </strong></label>
                <input class="add_img" type="file" name="cover" value="{{$producto->cover}}">
                <br>
                <label for="name"><strong> {{$producto->cover}} </strong></label>
            </div>
            <div class="button">
                <input type="submit" name="+fotos" class="btn btn-info btn-sm boton-eliminar" style="margin:2%; background-color:#007BFF;border-color:#007BFF;" value="Agregar Fotos">
            </div>
            <br>
            <div class="form-group">
                <label for="resume"><strong>Resumen del producto</strong> </label>
                <input required type="text"maxlength="60" name="resume" value="{{$producto->resume}}" class="form-control" maxlength="60">
            </div>
            <div class="form-group">
                <label for="descripcion"><strong> Descripción del producto</strong></label>
                <textarea style="resize:none;" required type="text" name="description" value="" class="form-control">{{$producto->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="category_id"><b> Categoría </b></label>
                <select required class="form-control" name="category_id" id="category_id">
                    <option value="{{ $producto->category->id }}" selected>{{ $producto->category->name }}</option>
                    @isset($allCategories)
                        @foreach($allCategories as $categoria)
                            @if ($producto->category->id != $categoria->id)
                                <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                            @endif
                        @endforeach
                    @endisset
                </select>
            </div>
            <div class="form-group">
                <label for="category_id"><b> Subcategoría </b></label>
                <select required enabled id="subcategory_id" class="form-control" name="subcategory_id" value="{{ $producto->subcategory->id }}">
                <option value="{{ $producto->subcategory->id }}"></option>
            </select>
            </div>
            <br>
            <div class="d-flex md-form mt-0" style="justify-content:center">
                <a href="/productos/cargar" class="btn btn-info btn-sm boton-eliminar" role="button" style="margin:2%; background-color:#007BFF;border-color:#007BFF;">Volver</a>
                <input type="submit" name="confirm" class="btn btn-info btn-sm boton-eliminar" style="margin:2%; background-color:#007BFF;border-color:#007BFF;" value="Confirmar Cambios">
            </div>
        </form>
    </div>
    <div class="col-11 form-categorias1">
        <div id="listaProductos" class="panel panel-default">
            <div class="panel-body">
                <div class="pull-left"><h3>Lista Productos</h3></div>
                <div class="table-container">
                    <table id="mytable" class="table table-bordered table-striped">
                        <thead>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Código</th>
                            <th>Resumen</th>
                            <th>Descripción</th>
                            <th>Cover</th>
                            <th>Categoría</th>
                            <th>Subcategoría</th>
                            <th>Fotos</th>
                            <th>Editar</th>
                            <th style="color:red;">Borrar</th>
                        </thead>
                        <tbody>
                            @if($productos ?? ''->count())
                                @foreach($productos ?? '' as $producto)
                                    <tr style="font-size:13px">
                                        <td>{{$producto->id}}</td>
                                        <td>{{$producto->name}}</td>
                                        <td>{{$producto->code}}</td>
                                        <td>{{$producto->resume}}</td>
                                        <td>{{$producto->description}}</td>
                                        @if ( $producto->cover == true)
                                            <td>Si</td>
                                        @endif
                                        @if ($producto->cover == false)
                                            <td>No</td>
                                        @endif
                                        <td>{{$producto->category->name}}</td>
                                        <td>{{$producto->subcategory->name}}</td>
                                        <td style="text-align:center"><a class="btn btn-secondary btn-sm" href="{{action('MultimediaController@create', $producto->id)}}">
                                            <i class="fa fa-camera" style="font-size:16px"></i>
                                        </a></td>
                                        <td style="text-align:center">
                                            <a class="btn btn-primary btn-sm" href="{{action('ProductController@edit', $producto->id)}}">
                                            <i class="fa fa-pencil" style="font-size:16px"></i>
                                            </a>
                                        </td>
                                        <td style="text-align:center">
                                            <form action="{{action('ProductController@destroy', $producto->id)}}" method="post">
                                                {{csrf_field()}}
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button class="btn btn-danger btn-sm" type="submit" style="margin:0 !important;">
                                                    <i class="fa fa-trash" style="font-size:16px"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">No hay registros actualmente</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection