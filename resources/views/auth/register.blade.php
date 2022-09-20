@extends('layouts.master')
@section('content')

<div class="container1">
  <main class="register">
    <div class="cajita2">

      <h1 class="inicioSesion">Registro!</h1>

      <form class="formularioWeb" action="{{action('UserController@store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row d-flex flex-row">
            <div class="col-lg-6 p-0">
                <input class="inputForm w-100" type="text" name="name" placeholder="Nombre" value="{{ old('name') }}">
                @error('name')<span class="errors">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-6 p-0">
                <input class="inputForm w-100" type="text" name="last_name" placeholder="Apellido" value="{{ old('last_name') }}">
                @error('last_name')<span class="errors">{{ $message }}</span> @enderror
            </div>
        </div>


        <div class="row d-flex flex-row">
            <div class="col-lg-12 p-0">
                <input class="inputForm w-100" type="text" name="business_name" placeholder="Razón social" value="{{ old('business_name') }}">
                @error('business_name')<span class="errors">{{ $message }}</span> @enderror
            </div>
        </div>


        <div class="row d-flex flex-row">
            <div class="col-lg-12 d-flex justify-content-between p-0">
                <div class="col-lg-4 p-0">
                    <input class="inputForm w-100" type="text" name="address" placeholder="Dirección" value="{{ old('address') }}">
                    @error('address')<span class="errors">{{ $message }}</span> @enderror
                </div>
                <div class="col-lg-4">
                    <input class="inputForm w-100" type="text" name="department" placeholder="Localidad" value="{{ old('department') }}">
                    @error('department')<span class="errors">{{ $message }}</span> @enderror
                </div>
                <div class="col-lg-4 p-0">
                    <input class="inputForm w-100" type="text" name="province" placeholder="Provincia" value="{{ old('province') }}">
                    @error('province')<span class="errors">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="row d-flex flex-row">
            <div class="col-lg-12 d-flex justify-content-between p-0">
                <div class="col-lg-6 p-0">
                    <input class="inputForm w-100" type="text" name="zip_code" placeholder="Código postal" value="{{ old('zip_code') }}">
                    @error('zip_code')<span class="errors">{{ $message }}</span> @enderror
                </div>
                <div class="col-lg-6 p-0">
                    <input class="inputForm w-100" type="text" name="shipment" placeholder="Nombre del transporte" value="{{ old('shipment') }}">
                    @error('shipment')<span class="errors">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="row d-flex flex-row">
            <div class="col-lg-12 d-flex justify-content-between p-0">
                <div class="col-lg-6 p-0">
                    <select class="inputForm w-100" name="tipo_iva" id="tipo_iva" onchange="checkTipoIva()">
                        <option value="ri">RI</option>
                        <option value="mt">Monotributo</option>
                        <option value="cf">CF</option>
                    </select>
                </div>
                <div id="cuit" class="col-lg-6 p-0">
                    <input class="inputForm w-100" type="text"  name="cuit" placeholder="Nro CUIT" value="{{ old('cuit') }}">
                    @error('cuit')<span class="errors">{{ $message }}</span> @enderror
                </div>
                <div id="dni" class="col-lg-6 p-0">
                    <input class="inputForm w-100" type="text"  name="dni" placeholder="Nro DNI" value="{{ old('dni') }}">
                    @error('dni')<span class="errors">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>


        <div class="row d-flex flex-row">
            <div class="col-lg-12 d-flex justify-content-between p-0">
                <div class="col-lg-6 p-0">
                    <input class="inputForm w-100" type="text" name="phone" placeholder="Teléfono" value="{{ old('phone') }}">
                    @error('phone')<span class="errors">{{ $message }}</span> @enderror
                </div>
                <div class="col-lg-6 p-0">
                    <input class="inputForm w-100" type="text" name="email" placeholder="Correo electrónico" value="{{ old('email') }}">
                    @error('email')<span class="errors"> {{ $message }}</span> @enderror
                </div>
            </div>
        </div>


        <div class="row d-flex flex-row">
            <div class="col-lg-12 d-flex justify-content-between p-0">
                <div class="col-lg-6 p-0">
                    <input id="password" type="password" class="inputForm w-100 @error('password') is-invalid @enderror" name="password" placeholder = 'Password' autocomplete="new-password">
                    @error('password')<span class="errors"> {{ $message }}</span> @enderror
                </div>
                <div class="col-lg-6 p-0">
                    <input id="password-confirm" type="password" class="inputForm w-100" name="password_confirmation" placeholder = 'Confirma la password' autocomplete="new-password">
                    @error('password')<span class="errors"> {{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <br>
        <div class="divSubmitLogin">
          <button class="botonLogin" type="submit" name="submit">{{ __('Enviar') }}</button>
        </div>

      </form>
    </div>
  </main>
</div>

@endsection

@section('scripts')
    <script src="{{asset('js/register.js')}}"></script>
@endsection
