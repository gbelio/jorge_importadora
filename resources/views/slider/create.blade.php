@extends('layouts.master')
@section('content')
<div class="offset-2 col-8 form-categorias" style="min-height: 450px">
    <div id="listaCategorias">
        <div style="display:flex; flex-direction:row; justify-content:space-between">
            <h3 style="display:inline-block">Agregar Imagen al Slider</h3>
            <button id="botonFormProd" style="font-size: 0px; background-color: white; color: black;" class="pull-right"><i class="fa fa-plus-square-o pull-right" style="font-size:30px; margin:0 !important"></i></button>
            <button id="botonFormProd1" style="font-size: 0px; background-color: white; color: black; display:none" class="pull-right"><i class="fa fa-minus-square-o" style="font-size:30px"></i></button>
        </div>
        <div id="target" style="display:none">
            <br>
            <form class="form-group" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="button">
                    <label for="s_img" class="s_img">Selecionar Imagen</label>
                    <input required class="" type="file" name="s_img" multiple>
                </div>
                @error('s_img')
                <span class="errors">{{ $message }}</span>
                @enderror
                <br>
                <div class="form-group" style="display:none">
                    <label for="s_estado">Estado</label>
                    <input type="text" name="s_estado" value="{{1}}" class="form-control" maxlength="190">
                </div>
                @error('s_estado')
                    <span class="errors">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="s_estado">Redirección <strong>(Ej: https://www.google.com.ar)</strong></label>
                    <input type="text" name="s_link" value="" class="form-control" maxlength="190" placeholder="https://www.jorgeimportadora.com">
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" value="Guardar" class="btn btn-primary btn-sm" >
                </div>
            </form>
        </div>
    </div>
    <br>
    <div id="listaCategorias" class="panel panel-default">
        <div class="panel-body">
            <div class="pull-left"><h3>Lista Slider</h3></div>
            <div class="table-container">
                <table id="mytable" class="table table-bordered table-striped">
                    <thead>
                        <th>Id</th>
                        <th>Imagen</th>
                        <th>Estado</th>
                        <th>Redirección (Con "https://")</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        @if($sliders->count())
                            @foreach($sliders as $slider)
                                <tr style="font-size:13px; text-align:center">
                                    <td>{{$slider->id}}</td>
                                    <td>{{$slider->s_img}}</td>
                                    <td>
                                        @if( $slider->s_estado == 1)
                                            <form action="{{action('SliderController@update', $slider->id)}}" method="post">
                                                <br>
                                                @csrf
                                                {{ method_field('PATCH') }}
                                                <button style="font-size:15px" type="submit" name="s_estado" value="0"><i class="fa fa-check-square-o"></i></button>
                                            </form>
                                        @else
                                            <form action="{{action('SliderController@update', $slider->id)}}" method="post">
                                                <br>
                                                @csrf
                                                {{ method_field('PATCH') }}
                                                <button style="font-size:15px" type="submit" name="s_estado" value="1"><i class="fa fa-close"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>{{$slider->s_link}}</td>
                                    <td style="text-align:center">
                                        <a class="btn btn-primary btn-sm" href="{{action('SliderController@edit', $slider->id)}}">
                                            <i class="fa fa-pencil" style="font-size:16px"></i>
                                        </a>
                                    </td>

                                    <td style="text-align:center">
                                        <form action="{{action('SliderController@destroy', $slider->id)}}" method="post">
                                        {{csrf_field()}}
                                            {{-- <input name="_method" type="hidden" value="DELETE"> --}}
                                            <input class="serdelete_val_id5" name="_method" type="hidden" value="{{$slider->id}}">
                                            <button id="delete5" data-id="{{$slider->id}}" class="btn btn-danger btn-sm" type="submit" style="margin:0 !important;">
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
        <div style="display:flex; flex-direction: row; justify-content:center; align-items:center;">
            {{ $sliders->links() }}
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/toggle.js')}}"></script>
@endsection
