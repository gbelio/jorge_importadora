@extends('layouts.master')
@section('content')

<div  style="min-height:450px;">
    <section class="offset-0 col-11 form-categorias">
        <div class="agregarProducto">
            <div style="display:flex; flex-direction:row; justify-content:space-between">
                <h3 style="display:inline-block; font-family:'Raleway'; font-weight:bold;">Agregar Producto</h3>
                <button id="botonFormProd" style="font-size: 0px; background-color: white; color: black;" class="pull-right"><i class="fa fa-plus-square-o pull-right" style="font-size:30px; margin:0 !important"></i></button>
                <button id="botonFormProd1" style="font-size: 0px; background-color: white; color: black; display:none" class="pull-right"><i class="fa fa-minus-square-o" style="font-size:30px"></i></button>
            </div>
    
            <div id="target" style="display:none">
                <br>
                <form class="form-group" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class=form-group style="display:none;">
                        <input required type="text" name= "user_id" value="{{Auth::user()->id}}">
                    </div>

                    <div class="form-group">
                        <label for="code"><strong> Código</strong></label>
                        <input required type="text" name="code" value="{{ old("code") }}" class="form-control" maxlength="190">
                    </div>   
                    @error('code')
                    <span class="errors">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="producto"><strong> Nombre del producto</strong></label>
                        <input required type="text" name="name" value="{{ old("name") }}" class="form-control">
                    </div>
                    @error('name')
                    <span class="errors">{{ $message }}</span>
                    @enderror        
                        
                    <div class="form-group">
                        <label for="resume"><strong>Resumen del producto</strong> </label>
                        <input required type="text" name="resume" value="{{ old("resume") }}" class="form-control" maxlength="60">
                    </div>
                    @error('resume')
                    <span class="errors">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="descripcion"><strong> Descripción del producto</strong></label>
                        <textarea style="resize:none;" required type="text" name="description" value="{{ old("description") }}" class="form-control" maxlength="190"> </textarea>
                    </div>
                    @error('description')
                    <span class="errors">{{ $message }}</span>
                    @enderror
        
                    <div class="form-group">
                        <label for="genero"><strong>Categoría</strong> </label>
                        <select class="form-control" name="category_id">
                            <option value="" disabled selected><strong>Seleccione la categoría correspondiente</strong></option>
        
                            @foreach($allCategories as $categoria)
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
                        <label for="genero"><strong> Sub Categoría</strong></label>
                        <select class="form-control" name="subcategory_id">
                            <option value="" disabled selected><strong>Seleccione la sub categoría correspondiente</strong> </option>
        
                            @foreach($subcategories as $subcategory)
                                @if ($subcategory->id == old("subcategory_id"))
                                    <option value="{{ $subcategory->id }}" selected>{{ $subcategory->name }}</option>
                                @else
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endif
                            @endforeach
        
                        </select>
                    </div>
                    @error('subcategory_id')
                    <span class="errors">{{ $message }}</span>
                    @enderror
        
                    {{-- Si el ID de la categoría es igual al catgory_id de subcategoría, que muestre las subcategorías con ese ID --}}
        
                    <div class="button">
                        <label for="poster" class="add_img"><strong>Selecione una imagen de portada</strong> </label>
                        <input required class="" type="file" name="cover">
                    </div>
                    @error('cover')
                    <span class="errors">{{ $message }}</span>
                    @enderror
        
                    <br>
        
                    <div class="form-group">
                        <input required type="submit" class="btn btn-primary __agregarProd" value="Agregar Producto" id="addMovie">
                    </div>
                </form>
            </div>
        </div>
    </section>
    
    {{-- Lista de productos --}}
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
                {{-- <div style="display:flex; flex-direction: row; justify-content:center; align-items:center;">
                    {{ $productos->links() }}
                </div> --}}
        </div>
    </div>
    {{-- Lista de productos --}}

</div>

@endsection