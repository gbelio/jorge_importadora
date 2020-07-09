@extends('layouts.master')
@section('content')

<div class="offset-2 col-8 form-categorias">

    <div id="listaCategorias">
        <h3>Agregar Imagen en Slider</h3>
        <br>
        
        <form class="form-group" action="" method="post" enctype="multipart/form-data">
            @csrf
            
            <div class="button">
                <label for="s_img" class="s_img">Selecionar Imagen</label>
                <input class="" type="file" name="s_img" multiple>
            </div>
            @error('s_img')
            <span class="errors">{{ $message }}</span>
            @enderror

            <div class="form-group">
                <label for="s_estado">Estado</label>
                <p>1 = Activado | 0 = Desactivado</p>
                <input type="text" name="s_estado" value="" class="form-control" maxlength="190">
            </div>   
            @error('s_estado')
            <span class="errors">{{ $message }}</span>
            @enderror

            <div class="form-group">
                <label for="s_estado">Redirección</label>
                <input type="text" name="s_link" value="https://" class="form-control" maxlength="190">
            </div>
            
            <br>

            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-sm" >
            </div>

        </form>
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
                    <th>Redirección (Con "https://" )</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @if($sliders->count())  
                    @foreach($sliders as $slider)  
                    <tr style="font-size:13px">
                        <td>{{$slider->id}}</td>
                        <td>{{$slider->s_img}}</td>
                        <td>{{$slider->s_estado}}</td>
                        <td>{{$slider->s_link}}</td>

                        <td style="text-align:center">
                            <a class="btn btn-primary btn-sm" href="{{action('SliderController@edit', $slider->id)}}">
                                <i class="fa fa-pencil" style="font-size:16px"></i>
                            </a>
                        </td>

                        <td style="text-align:center">

                            <form action="{{action('SliderController@destroy', $slider->id)}}" method="post">
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
        <div style="display:flex; flex-direction: row; justify-content:center; align-items:center;">
            {{ $sliders->links() }}
        </div>
    </div>
</div>

@endsection