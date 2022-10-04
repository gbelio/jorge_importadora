@extends('layouts.master')
@section('content')

<div class="" style="min-height:450px; margin-top:125px;margin-bottom:25px">
    <div id="listaCategorias" class="offset-2 col-8 form-categorias">
        <div style="display:flex; flex-direction:row; justify-content:center; align-items:baseline">
            <h3 style="display:inline-block; 
            color: #041c7c; 
            font-family: 'Raleway', sans-serif;
            font-size: 1.5rem;
            font-weight: bolder;">
            Editar perfil de usuario
            </h3>
        </div>
        <br>
        <form method="POST" action="{{action('ProfileController@update', $usuario->id)}}" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            @csrf
            <div style="display:flex; justify-content:space-between;">
                <div class="form-group" style="width: 49%;">
                    <label for="name">Nombre</label>
                    <input name="name" required maxlength="25" value="{{$usuario->name}}" type="text" class="form-control" placeholder="">
                </div>
                <br>
                <div class="form-group" style="width: 49%;">
                    <label for="last_name">Apellido</label>
                    <input name="last_name" maxlength="25" value="{{$usuario->last_name}}" type="text" class="form-control" placeholder="">
                </div>
            </div>
            <div class="form-group" style="width: 99%;">
                <label for="business_name">Razón Social</label>
                <input name="business_name" maxlength="25" value="{{$usuario->business_name}}" type="text" class="form-control" placeholder="">
            </div>
            <div class="form-group" style="width: 99%;">
                <label for="categoria">Dirección</label>
                <input required type="text" name="address" value="{{$usuario->address}}" class="form-control">
            </div>
            <div style="display:flex; justify-content:space-between; width:99%;">
                <div class="form-group" style="width: 33%;">
                    <label for="categoria">Localidad</label>
                    <input required type="text" name="department" value="{{$usuario->department}}" class="form-control">
                </div>
                <div class="form-group" style="width: 33%;">
                    <label for="categoria">Provincia</label>
                    <input required type="text" name="province" value="{{$usuario->province}}" class="form-control">
                </div>
                <div class="form-group" style="width: 33%;">
                    <label for="categoria">Código postal</label>
                    <input required type="text" name="zip_code" value="{{$usuario->zip_code}}" class="form-control">
                </div>
            </div>
            <div class="form-group" style="width: 99%;">
                <label for="categoria">Nombre transporte</label>
                <input required type="text" name="shipment" value="{{$usuario->shipment}}" class="form-control">
            </div>
            <div style="display:flex; justify-content:space-between; width:99%;">
                <div class="mr-1 ml-0" style="width: 40%;">
                    <label for="tipo_iva">Tipo Iva</label>
                    <select class="editUser w-100 m-0" name="tipo_iva" id="tipo_iva" onchange="checkTipoIva()">
                        <option value="ri" @if($usuario->iva === "ri") selected @endif>RI</option>
                        <option value="mt" @if($usuario->iva === "mt") selected @endif>Monotributo</option>
                        <option value="cf" @if($usuario->iva === "cf") selected @endif>CF</option>
                    </select>
                </div>
                <div id="cuit" class="m-0" style="width:59%">
                    <label for="cuit"></label>
                    <input class="form-control w-100" type="text"  name="cuit" placeholder="Nro CUIT" value="{{$usuario->cuit}}">
                    @error('cuit')<span class="errors">{{ $message }}</span> @enderror
                </div>
                <div id="dni" class="m-0" style="width:59%">
                    <label for="dni"></label>
                    <input class="form-control w-100" type="text"  name="dni" placeholder="Nro DNI" value="{{$usuario->dni}}">
                    @error('dni')<span class="errors">{{ $message }}</span> @enderror
                </div>
            </div>
            <br>
            <div style="display:flex; justify-content:space-between; width:99%;">
                <div class="button" style="width:49%;">
                    <label for="Email">Email</label>
                    <label type="email" name="email" value="" class="form-control">{{ $usuario->email }}</label>
                </div>
                <div class="form-group" style="width:49%; margin:0;">
                    <label for="phone">Teléfono</label>
                    <input name="phone" maxlength="25" value="{{$usuario->phone}}" type="text" class="form-control" placeholder="" style="margin:0;">
                </div>
            </div>
            <br>
            <div style="display:flex; justify-content:space-between; width:99%;">
                <div class="form-group" style="width:49%; margin:0;">
                    <label for="Password">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                </div>
                <div class="form-group" style="width:49%; margin:0;">
                    <label for="repassword">Confirmar Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                </div>
                @isset($error)
                    <span style="color:red">{{$error}}</span>
                @endisset
            </div>
            <div class="d-flex md-form" style="justify-content:center; margin-top:2rem;">
                <a href="{{ url()->previous() }}" class="btn btn-info btn-sm botonLogin" role="button" style="margin:2%; background-color:#ababab;border-color:#ababab;">Volver</a>
                <input type="submit" name="confirm" class="btn btn-info btn-sm botonLogin" style="margin:2%; background-color:#3f6eb0;border-color:#3f6eb0;" value="Confirmar Cambios">
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/register.js')}}"></script>
@endsection
