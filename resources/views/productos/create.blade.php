@extends('layouts.master')
@section('content')

{{-- @if(count($errors) > 0)
    <div class="alert alert-danger __mt-30" >
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<br> --}}

<section class="offset-2 col-8 form-categorias">
    <div class="agregarProducto">
        <h3 class="">Agregar Producto</h3>
        <br>
        <form class="form-group" action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class=form-group style="display:none;">
                <input type="text" name= "user_id" value="{{Auth::user()->id}}">
            </div>
            <div class="form-group">
                <label for="producto">Nombre del producto</label>
                <input type="text" name="name" value="{{ old("name") }}" class="form-control">
            </div>
            @error('name')
            <span class="errors">{{ $message }}</span>
            @enderror

            <div class="form-group">
                <label for="code">Código</label>
                <input type="text" name="code" value="{{ old("code") }}" class="form-control" maxlength="190">
            </div>   
            @error('code')
            <span class="errors">{{ $message }}</span>
            @enderror

            <div class="form-group">
                <label for="descripcion">Descripción del producto</label>
                <input type="text" name="description" value="{{ old("description") }}" class="form-control" maxlength="190">
            </div>
            @error('description')
            <span class="errors">{{ $message }}</span>
            @enderror

            <div class="form-group">
                <label for="resume">Resumen del producto</label>
                <input type="text" name="resume" value="{{ old("resume") }}" class="form-control" maxlength="60">
            </div>
            @error('resume')
            <span class="errors">{{ $message }}</span>
            @enderror

            <div class="form-group">
                <label for="genero">Categoría</label>
                <select class="form-control" name="category_id">
                    <option value="" disabled selected>Seleccione la categoría correspondiente</option>
                @foreach($categorias as $categoria)
                    @if ($categoria->id == old("category_id"))
                        <option value="{{ $categoria->id }}" selected>{{ $categoria->name }}</option>
                    @else
                        <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                    @endif
                @endforeach
                </select>
            </div>
            @error('category_id')
            <span class="errors">{{ $message }}</span>
            @enderror

            <div class="form-group">
                <label for="genero">Sub Categoría</label>
                <select class="form-control" name="subcategory_id">
                    <option value="" disabled selected>Seleccione la sub categoría correspondiente</option>
                @foreach($subcategorias as $subcategoria)
                    @if ($subcategoria->id == old("subcategory_id"))
                        <option value="{{ $subcategoria->id }}" selected>{{ $subcategoria->name }}</option>
                    @else
                        <option value="{{ $subcategoria->id }}">{{ $subcategoria->name }}</option>
                    @endif
                @endforeach
                </select>
            </div>
            @error('subcategory_id')
            <span class="errors">{{ $message }}</span>
            @enderror

            <div class="button">
                <label for="poster" class="add_img">Selecionar Imagen</label>
                <input class="" type="file" name="cover">
            </div>
            @error('cover')
            <span class="errors">{{ $message }}</span>
            @enderror

            <br>

            <div class="form-group">
                <input type="submit" class="btn btn-primary __agregarProd" value="Agregar Producto" id="addMovie">
            </div>
        </form>
    </div>
</section>

    <br>

<div class="col-11 form-categorias1">
    <div id="listaProductos" class="panel panel-default">
        <div class="panel-body">
            <div class="pull-left"><h3>Lista Categorias</h3></div>
    
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
                        <th></th>
                        <th></th>
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
                            
                            <td>{{$producto->category_id}}</td>
                            <td>{{$producto->subcategory_id}}</td>
                        
                            <td style="text-align:center"><a class="btn btn-primary btn-sm" href="{{action('ProductController@edit', $producto->id)}}">
                                <i class="fa fa-pencil" style="font-size:16px"></i>
                            </a></td>
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
            <div style="display:flex; flex-direction: row; justify-content:center; align-items:center;">
                {{ $productos->links() }}
            </div>
    </div>
</div>

@endsection