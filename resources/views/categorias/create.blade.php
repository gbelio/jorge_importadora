@extends('layouts.master')
@section('content')

<div class="offset-2 col-8 form-categorias">

    <div id="listaCategorias">
        <h3>Agregar Categoria</h3>
        <br>
        <form class="form-group" action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="categoria">Nombre de la categoría</label>
                <input type="text" name="name" value=" " class="form-control">
            </div>
            <br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-sm" value="Agregar Categoria" id="addCategory">
            </div>
        </form>
    </div>
<br>
    <div id="listaCategorias" class="panel panel-default">
        <div class="panel-body">
        <div class="pull-left"><h3>Lista Categorias</h3></div>

        <div class="table-container">
            <table id="mytable" class="table table-bordered table-striped">
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @if($categorias->count())  
                    @foreach($categorias as $categoria)  
                    <tr style="font-size:13px">
                        <td>{{$categoria->id}}</td>
                        <td>{{$categoria->name}}</td>
                        <td style="text-align:center"><a class="btn btn-primary btn-sm" href="{{action('CategoryController@edit', $categoria->id)}}">
                            <i class="fa fa-pencil" style="font-size:16px"></i>
                        </a></td>
                        <td style="text-align:center">

                        <form action="{{action('CategoryController@destroy', $categoria->id)}}" method="post">
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
        {{ $categorias->links() }}
    </div>
</div>

@endsection