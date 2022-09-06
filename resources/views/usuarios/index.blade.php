@extends('layouts.master')
@section('content')
    <div class="offset-2 col-8 form-categorias" style="min-height:450px;">
        @if($errors->any())
            <h5 style="color:red">{{$errors->first()}}</h5>
        @endif
        <div id="listaCategorias" class="panel panel-default">
            <div class="panel-body">
                <div class="pull-left"><h3>Lista Usuarios</h3></div>
                <div class="table-container">
                    <table id="mytable" class="table table-bordered table-striped">
                        <thead>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Creado</th>
                            <th>Editar</th>
                            <th style="color:red;">Borrar</th>
                        </thead>
                        <tbody>
                        @if($usuarios->count())
                            @foreach($usuarios as $usuario)
                                @if($usuario->role != 9)
                                    <tr style="font-size:13px">
                                        <td>{{$usuario->name}} {{$usuario->last_name ?? ''}}</td>
                                        <td>{{$usuario->phone ?? 'S/D'}}</td>
                                        <td>{{$usuario->email ?? 'S/D'}}</td>
                                        <td>{{$usuario->created_at}}</td>
                                        <td style="text-align:center">
                                            <a class="btn btn-primary btn-sm" href="/usuarios/editar/{{$usuario->id}}">
                                                <i class="fa fa-pencil" style="font-size:16px"></i>
                                            </a>
                                        </td>
                                        <td style="text-align:center">
                                            <form action="{{action('ProfileController@destroy', $usuario->id)}}" method="post">
                                                {{csrf_field()}}
                                                <input class="serdelete_val_id8" name="_method" type="hidden" value="{{$usuario->id}}">
                                                <button id="delete8" data-id="{{$usuario->name}}" class="btn btn-danger btn-sm" type="submit" style="margin:0 !important;">
                                                    <i class="fa fa-trash" style="font-size:16px"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">No hay usuarios !!</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $usuarios->links() }}
        </div>
    </div>
@endsection
