@extends('layouts.master')
@section('content')
    <div  style="min-height:450px;">
        <section class="offset-0 col-11 form-categorias">
            <div class="agregarProducto">
                <div style="display:flex; flex-direction:row; justify-content:space-between">
                    <h3 style="display:inline-block; font-family:'Raleway'; font-weight:bold;">Agregar Color</h3>
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
                            <label for="code"><strong>Código hexadecimal</strong></label>
                            <input required type="text" maxlength="15" name="hex" id="hex" value="{{ old("hex") }}" class="form-control">
                        </div>
                        @error('hex')
                        <span class="errors">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="producto"><strong>Nombre</strong></label>
                            <input required type="text" name="name" id="name"  maxlength="25" value="{{ old("name") }}" class="form-control">
                        </div>
                        @error('name')
                        <span class="errors">{{ $message }}</span>
                        @enderror


                        <br>
                        <div class="form-group">
                            <input required type="submit" class="btn btn-primary __agregarProd" value="Agregar Color" id="addMovie">
                        </div>
                    </form>

                </div>
            </div>
        </section>
        {{-- Lista de colores --}}
        <div class="col-11 form-colores">
            <div id="listaColores" class="panel panel-default">
                <div class="panel-body panel-colores">
                    <div class="pull-left"><h3>Lista de colores</h3></div>
                    <div class="table-container table_colores">
                        <table id="mytable" class="table table-bordered table-striped">
                            <thead>
                                <th>Nombre</th>
                                <th>Hexadecimal</th>
                                <th>Color</th>
                                <th>Editar</th>
                                <th style="color:red;">Borrar</th>
                            </thead>
                            <tbody>
                            @if($colores)
                                @foreach($colores as $color)
                                    <tr style="font-size:13px">
                                        <td>{{$color->name}}</td>
                                        <td>{{$color->hex}}</td>
                                        <td><div style="background-color:{{$color->hex}}; width: 100%; height: 40px"></div></td>
                                        <td style="text-align:center">
                                            <a class="btn btn-primary btn-sm" href="{{action('ColourController@edit', $color->id)}}">
                                                <i class="fa fa-pencil" style="font-size:16px"></i>
                                            </a>
                                        </td>
                                        <td style="text-align:center">
                                            <form action="{{action('ColourController@destroy', $color->id)}}" method="post">
                                                {{csrf_field()}}
                                                <input class="serdelete_val_id7" name="_method" type="hidden" value="{{$color->id}}">
                                                <button id="delete7" data-id="{{$color->id}}" class="btn btn-danger btn-sm" type="submit" style="margin:0 !important;">
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
    {{$colores->links()}}
@endsection
@section('scripts')
    <script src="{{asset('js/toggle.js')}}"></script>
@endsection
