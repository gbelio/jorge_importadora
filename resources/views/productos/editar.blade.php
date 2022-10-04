@extends('layouts.master')
@section('content')

<div class="" style="min-height:450px; margin-top:125px;">
    <div id="listaCategorias" class="offset-2 col-8 form-categorias">
        <div style="display:flex; flex-direction:row; justify-content:space-between; align-items:baseline">
            <h3 style="display:inline-block">Editar Producto</h3>

            <form id="formularioDeleteEdit" action="{{action('ProductController@destroy', $producto->id)}}" method="post">
                {{csrf_field()}}
                <input class="serdelete_val_id_6" name="_method" type="hidden" value="{{$producto->id}}">
                <input class="serdelete_val_id_7" name="_method" type="hidden" value="{{$producto->name}}">

                <button id="delete6" data-id="{{$producto->id}}" type="submit" style="margin:0 !important;">
                    <i class="fa fa-trash" style="font-size: 30px; color:black"> </i>
                </button>

            </form>

        </div>
        <br>
        <div style="display:flex; flex-direction:row; justify-content:center; align-items:center">
            <img style="max-width: 500px; max-height: 500px; " src="/storage/{{$producto->cover}}" alt="imagen de producto">
        </div>

        <br>

        <div class="form-group">
            <form action="{{action('ProductController@deactivate', $producto->id)}}" method="post" style=" display: flex; align-items: center;">
                {{csrf_field()}}
                @method('PATCH')
                <input type="hidden" name="active" value="{{$producto->active == 1 ? 0 : 1}}">
                <label for="colores" style="margin:0 20px 0 0; padding: 2px 5px; background-color: #f1f1f1; border-radius: 5px;"><strong> Cambiar estado: </strong></label>
                <br>
                <button id="deactivate" class="btn btn-sm" type="submit" style="margin:0 !important; color: white; {{$producto->active == 1 ? 'background-color: red' : 'background-color: green'}}">
                    {{$producto->active == 1 ? 'Desactivar Producto' : 'Activar Producto'}}
                </button>
            </form>

            <br>

            <!--            Editar colores-->
            @if(count($rest_of_colours) > 0)
            <form action="{{action('ProductController@editColour', $producto->id)}}" method="post" >
                {{ method_field('POST') }}
                @csrf
                <label for="colores" style="margin:0 20px 0 0; padding: 2px 5px; background-color: #f1f1f1; border-radius: 5px;"><strong> Colores disponibles: </strong></label>
                <br>
                <input type="checkbox" name ="colours[]" value="1" hidden checked>
                <div style="margin: 10px 0;">
                @foreach($rest_of_colours as $colour)
                    @if($colour->name !== "Sin Color")
                    <label class="colour-container">
                        <div style="background-color: {{$colour->hex}}; width: 25px; height: 25px; margin-right: 10px; border-radius: 50%">
                        </div>
                        {{$colour->name}}
                        <input type="checkbox" name ="colours[]" value="{{$colour->id}}">
                        <span class="checkmark"></span>
                    </label>
                    @endif
                @endforeach
                </div>

                <div style="margin:0; display: flex; justify-content: flex-end;">
                    <button id="boton_agregar" type="submit" class="btn btn-info btn-sm" {{-- style="margin:0 2%; background-color:#007BFF;border-color:#007BFF;" --}}>Agregar Colores</button>
                </div>
            </form>
            @endif

            <!--            Eliminar colores-->
            <div style="display: flex; flex-direction: column; margin-top:20px;">
                <label for="colours_id" style="margin:0 20px 0 0; padding: 2px 5px; background-color: #f1f1f1; border-radius: 5px;width: fit-content;"><strong>Colores asignados a este producto:</strong></label>
                <div style="display: flex; flex-direction: row; margin-top: 15px; width: 100%; flex-wrap: wrap;">
                    @foreach($product_colours as $product_colour)
                         @if($product_colour->colour->name !== "Sin Color")
                            <form action="{{action('ProductController@deleteColour', $product_colour->product->id)}}" method="post" style="margin:0; display: flex; justify-content: center; align-items: center">
                                {{ method_field('DELETE') }}
                                @csrf
                                <input type="hidden" id="product_colour_id" name="product_colour_id" value="{{$product_colour->id}}">
                                <label class="colour-container" style="">
                                    <div style="background-color: {{$product_colour->colour->hex}}; width: 25px; height: 25px; margin-right: 10px; border-radius: 50%; border: 1px solid grey">
                                    </div>
                                    {{$product_colour->colour->name}}
                                </label>
                                <button class="button-delete-colour" type="submit" style="border:none; background-color: transparent !Important"><i class="fa fa-close" style="font-size: 10px; color: red"></i> </button>
                            </form>
                         @endif
                    @endforeach
                </div>
            </div>

        </div>
        <br>
        <form method="POST" action="" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            @csrf
            <div class="form-group">
                <label for="code" style="margin:0 20px 0 0; padding: 2px 5px; background-color: #f1f1f1; border-radius: 5px;"><strong>Código:</strong></label>
                <input required type="text" maxlength="25" name="code" value="{{$producto->code}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="name" style="margin:0 20px 0 0; padding: 2px 5px; background-color: #f1f1f1; border-radius: 5px;"><strong> Nombre: </strong></label>
                <input name="name" maxlength="25" value="{{$producto->name}}" type="text" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label for="amount" style="margin:0 20px 0 0; padding: 2px 5px; background-color: #f1f1f1; border-radius: 5px;"><strong>Precio:</strong> </label>
                <input type="number" value="{{$producto->amount}}" min="0" step="0.01" name="amount" class="form-control">
            </div>
            <div class="button" style="margin-bottom:1%; display: flex; flex-direction: column; justify-content: flex-start; align-items: flex-start;">
                <label for="name" style="margin: 10px 0; padding: 2px 5px; background-color: #f1f1f1; border-radius: 5px;"><strong> Portada: </strong></label>
                <label for="name"><strong> {{$producto->cover}} </strong></label>
                <input class="add_img" type="file" name="cover" value="{{$producto->cover}}">
            </div>
            <div class="button" style="display: flex; flex-direction:column; justify-content: flex-start; margin: 10px 0;">
                <label for="name" style="width: fit-content; margin: 10px 0; padding: 2px 5px; background-color: #f1f1f1; border-radius: 5px;"><strong> Agregar fotos a la galería: </strong></label>
                <input hidden name="active" value={{$producto->active}}>
                <input type="submit" name="+fotos" class="btn btn-info btn-sm" style="margin: 0; background-color:black;border-color:black; color:white; width:fit-content; font-family:'Raleway', sans-serif;" value="Acceder a multimedia">
            </div>
            <br>
            <div class="form-group">
                <label for="resume" style="width: fit-content; margin: 10px 0; padding: 2px 5px; background-color: #f1f1f1; border-radius: 5px;"><strong>Resumen del producto:</strong> </label>
                <input required type="text"maxlength="60" name="resume" value="{{$producto->resume}}" class="form-control" maxlength="60">
            </div>
            <div class="form-group">
                <label for="descripcion" style="width: fit-content; margin: 10px 0; padding: 2px 5px; background-color: #f1f1f1; border-radius: 5px;"><strong> Descripción del producto:</strong></label>
                <textarea style="resize:none;" required type="text" name="description" value="" class="form-control">{{$producto->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="category_id" style="width: fit-content; margin: 10px 0; padding: 2px 5px; background-color: #f1f1f1; border-radius: 5px;"><b> Categoría: </b></label>
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
                <label for="category_id" style="width: fit-content; margin: 10px 0; padding: 2px 5px; background-color: #f1f1f1; border-radius: 5px;"><b> Subcategoría: </b></label>
                <select required enabled id="subcategory_id" class="form-control" name="subcategory_id" value="{{ $producto->subcategory->id }}">
                    <option value="{{ $producto->subcategory->id }}"></option>
                </select>
            </div>
            <br>
            <div class="d-flex md-form mt-0" style="justify-content:center">
                <div class="backButton"><a href="/productos/cargar" class="btn btn-info btn-sm" role="button" style="text-transform:uppercase;">Volver</a></div>
                <div class="backButton" style="margin-left: 5px; width: fit-content;">
                <input type="submit" name="confirm" class="btn btn-info btn-sm confirmar" style="height: 100%; margin: 0; text-transform: uppercase; font-weight: bold;" value="Confirmar Cambios">
                </div>
            </div>
        </form>
    </div>
    <div class="col-11 form-categorias1">
        <div id="listaProductos" class="panel panel-default">
            <div class="panel-body">
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
                            <th>Cambiar Estado</th>
                        </thead>
                        <tbody>
                            @if($productos)
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
                                                <input class="serdelete_val_id" name="_method" type="hidden" value="{{$producto->id}}">
                                                <button id="delete" data-id="{{$producto->id}}" class="btn btn-danger btn-sm" type="submit" style="margin:0 !important;">
                                                    <i class="fa fa-trash" style="font-size:16px"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td style="text-align:center">
                                            <form action="{{action('ProductController@deactivate', $producto->id)}}" method="post">
                                                {{csrf_field()}}
                                                @method('PATCH')
                                                <input type="hidden" name="active" value="{{$producto->active == 1 ? 0 : 1}}">
                                                <button id="deactivate" class="btn btn-sm" type="submit" style="margin:0 !important; color: white; {{$producto->active == 1 ? 'background-color: red' : 'background-color: green'}}">
                                                    {{$producto->active == 1 ? 'Desactivar' : 'Activar'}}
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
    <script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('js/CKEditorCFG.js')}}"></script>
    <script src="{{asset('js/subcategorias.js')}}"></script>
    <script>

    </script>
@endsection
