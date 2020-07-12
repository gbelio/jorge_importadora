@extends('layouts.master')
@section('content')

<div class="offset-2 col-8 form-categorias" style="min-height:450px;">

    <div id="listaCategorias">
        <div style="display:flex; flex-direction:row; justify-content:space-between">
            <h3 style="display:inline-block">Agregar Subcategoría</h3>
            <button id="botonFormProd" style="font-size: 0px; background-color: white; color: black;" class="pull-right"><i class="fa fa-plus-square-o pull-right" style="font-size:30px; margin:0 !important"></i></button>
            <button id="botonFormProd1" style="font-size: 0px; background-color: white; color: black; display:none" class="pull-right"><i class="fa fa-minus-square-o" style="font-size:30px"></i></button>
        </div>

        <div id="target" style="display:none">
            <br>
            <form class="form-group" action="" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="categoria"><strong> Nombre de la Subcategoría</strong></label>
                    <input required type="text" name="name" value="" class="form-control">
                </div>

                <div class="form-group"> 
                    <label for="genero"><strong>¿A qué categoría pertenece?</strong></label>
                    <select class="form-control" name="category_id">
                        @foreach($allCategories as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <br>

                <div class="form-group">
                    <input required type="submit" value="Agregar" class="btn btn-primary btn-sm" >
                </div>

            </form>
        </div>
    </div>
<br>
    <div id="listaCategorias" class="panel panel-default">
        <div class="panel-body">
        <div class="pull-left"><h3>Lista Subcategorias</h3></div>

        <div class="table-container">
            <table id="mytable" class="table table-bordered table-striped">
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>ID Categoría</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @if($subcategorias->count())  
                    @foreach($subcategorias as $subcategoria)  
                    <tr style="font-size:13px">
                        <td>{{$subcategoria->id}}</td>
                        <td>{{$subcategoria->name}}</td>
                        <td>{{$subcategoria->category->name}}</td>
                        <td style="text-align:center"><a class="btn btn-primary btn-sm" href="{{action('SubcategoryController@edit', $subcategoria->id)}}">
                            <i class="fa fa-pencil" style="font-size:16px"></i>
                        </a></td>
                        <td style="text-align:center">

                        <form action="{{action('SubcategoryController@destroy', $subcategoria->id)}}" method="post">
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
                        <td colspan="8">No hay registro !!</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        </div>
{{--         {{ $subcategorias->links() }} --}}
    </div>
</div>

@endsection