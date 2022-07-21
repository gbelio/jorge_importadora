@extends('layouts.master')
@section('content')
<div class="" style="min-height:450px; margin-top:125px;margin-bottom:25px">
    <div id="listaCategorias" class="offset-2 col-8 form-categorias">
        <div style="display:flex; flex-direction:row; justify-content:space-between; align-items:baseline">
            <h3 style="display:inline-block">Editar Perfil</h3>
        </div>
        <br>
        <form method="POST" action="{{action('ProfileController@update')}}" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            @csrf
            <div class="form-group">
                <label for="name" ><strong>Nombre</strong></label>
                <input name="name" required maxlength="25" value="{{Auth::user()->name}}" type="text" class="form-control" placeholder="">
            </div>
            <br>
            <div class="form-group">
                <label for="last_name" ><strong>Apellido</strong></label>
                <input name="last_name" maxlength="25" value="{{Auth::user()->last_name}}" type="text" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label for="phone" ><strong>Teléfono</strong></label>
                <input name="phone" maxlength="25" value="{{Auth::user()->phone}}" type="text" class="form-control" placeholder="">
            </div>
            <br>
            <div class="button" style="margin-bottom:1%;">
                <label for="Email">Email</label>
                <label type="email" name="email" value="" class="form-control">{{ Auth::user()->email }}</label>
            </div>
            <br>
            <div class="form-group">
                <label for="Password">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
            </div>
            <div class="form-group">
                <label for="repassword">Confirmar Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
            </div>
            @isset($error)
                <span style="color:red">{{$error}}</span>
            @endisset
            <br>
            <div class="d-flex md-form mt-0" style="justify-content:center">
                <a href="/" class="btn btn-info btn-sm boton-eliminar" role="button" style="margin:2%; background-color:#007BFF;border-color:#007BFF;">Volver</a>
                <input type="submit" name="confirm" class="btn btn-info btn-sm boton-eliminar" style="margin:2%; background-color:#007BFF;border-color:#007BFF;" value="Confirmar Cambios">
            </div>
        </form>
    </div>
</div>
@endsection
