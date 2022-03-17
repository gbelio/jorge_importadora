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
                        <label for="code"><strong>Código</strong></label>
                        <input required type="text" maxlength="50" name="code" value="{{ old("code") }}" class="form-control">
                    </div>
                    @error('code')
                        <span class="errors">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="producto"><strong>Nombre del producto</strong></label>
                        <input required type="text" name="name" maxlength="25" value="{{ old("name") }}" class="form-control">
                    </div>
                    @error('name')
                        <span class="errors">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="amount"><strong>Precio</strong> </label>
                        <input type="number" min="0" step="0.01" name="amount" value="{{ old("amount") }}" class="form-control">
                    </div>
                    @error('amount')
                        <span class="errors">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="resume"><strong>Resumen del producto</strong> </label>
                        <input required type="text"maxlength="60" name="resume" value="{{ old("resume") }}" class="form-control" maxlength="60">
                    </div>
                    @error('resume')
                        <span class="errors">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="descripcion"><strong> Descripción del producto</strong></label>
                        <textarea style="resize:none;" required type="text" name="description" value="{{ old("description") }}" class="form-control"></textarea>
                    </div>
                    @error('description')
                        <span class="errors">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="genero"><strong>Categorías</strong> </label>
                        <select required class="form-control" name="category_id" id="category_id">
                            <option value="0" disabled selected="true">Seleccionar Categoría</option>
                            @foreach ($allCategories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id')
                        <span class="errors">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="genero"><strong> Subcategoría</strong></label>
                        <select required enabled id="subcategory_id" class="form-control" name="subcategory_id"></select>
                    </div>
                    @error('subcategory_id')
                        <span class="errors">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="colores"><strong> Seleccionar colores</strong></label>
                        <br>
                        @foreach($colores as $color)
                            <label class="colour-container">
                                <div style="background-color: {{$color->hex}}; width: 25px; height: 25px; margin-right: 10px; border-radius: 50%">
                                </div>
                                {{$color->name}}
                                <input type="checkbox" name ="colours[]" value="{{$color->id}}">
                                <span class="checkmark"></span>
                            </label>
                        @endforeach
                    </div>

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
            <div class="panel-body panel-productos">
                <div class="pull-left"><h3>Lista Productos</h3></div>
                <div class="table-container table_productos">
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
                            @if($productos)
                                @foreach($productos as $producto)
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
                                            <i class="fa fa-camera" style="font-size:16px"></i></a>
                                        </td>
                                        <td style="text-align:center"><a class="btn btn-primary btn-sm" href="{{action('ProductController@edit', $producto->id)}}">
                                            <i class="fa fa-pencil" style="font-size:16px"></i></a>
                                        </td>
                                        <td style="text-align:center">
                                            <form action="{{action('ProductController@destroy', $producto->id)}}" method="post">
                                                {{csrf_field()}}
                                                <input class="serdelete_val_id" name="_method" type="hidden" value="{{$producto->id}}">
                                                <button id="delete" data-id="{{$producto->id}}" class="btn btn-danger btn-sm" type="submit" style="margin:0 !important;">
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
{{$productos->links()}}
@endsection
@section('scripts')
    <script src="{{asset('js/toggle.js')}}"></script>
    <script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('js/CKEditorCFG.js')}}"></script>
    <script src="{{asset('js/subcategorias.js')}}"></script>
@endsection
