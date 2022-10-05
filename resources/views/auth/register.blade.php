@extends('layouts.master')
@section('content')

<div class="container1">
  <main class="register">
    <div class="cajita2">

      <h1 class="inicioSesion">Registrar nuevo cliente</h1>

      @isset($response)
        <br>
        <p style="color:red; font-style:italic;">{{$response}}</p>
      @endisset

      <form class="formularioWeb" action="{{action('UserController@store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row d-flex flex-row">
            <div class="__translation">
                <input class="inputForm w-100" required type="text" name="name" placeholder=" " value="{{ old('name') }}">
                <span>Nombre</span>
                @error('name')<span class="errors">{{ $message }}</span> @enderror
            </div>
            <div class="__translation">
                <input class="inputForm w-100" type="text" name="last_name" placeholder=" " value="{{ old('last_name') }}">
                <span>Apellido</span>
                @error('last_name')<span class="errors">{{ $message }}</span> @enderror
            </div>
            <div class="__translation">
                <input class="inputForm w-100" type="text" name="business_name" placeholder=" " value="{{ old('business_name') }}">
                <span>Razón social</span>
                @error('business_name')<span class="errors">{{ $message }}</span> @enderror
            </div>
           {{--  <div class="col-lg-6 p-0">
                <input class="inputForm w-100" type="text" name="name" placeholder="Nombre" value="{{ old('name') }}">
                @error('name')<span class="errors">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-6 p-0">
                <input class="inputForm w-100" type="text" name="last_name" placeholder="Apellido" value="{{ old('last_name') }}">
                @error('last_name')<span class="errors">{{ $message }}</span> @enderror
            </div> --}}
        </div>


       {{--  <div class="row d-flex flex-row">
            <div class="col-lg-12 p-0">
                <input class="inputForm w-100" type="text" name="business_name" placeholder="Razón social" value="{{ old('business_name') }}">
                @error('business_name')<span class="errors">{{ $message }}</span> @enderror
            </div>
        </div> --}}


        <div class="row d-flex flex-row">
            <div class="__translation">
                <input class="inputForm w-100" type="text" name="address" placeholder=" " value="{{ old('address') }}">
                <span>Dirección</span>
                @error('address')<span class="errors">{{ $message }}</span> @enderror
            </div>
               {{--  <div class="col-lg-4 p-0">
                    <input class="inputForm w-100" type="text" name="address" placeholder="Dirección" value="{{ old('address') }}">
                    @error('address')<span class="errors">{{ $message }}</span> @enderror
                </div> --}}
                <div {{-- class="col-lg-4 p-0" --}} class="__translation">
                    <input class="inputForm w-100" type="text" name="department" placeholder=" " value="{{ old('department') }}">
                    <span>Localidad</span>
                    @error('department')<span class="errors">{{ $message }}</span> @enderror
                </div>
                <div {{-- class="col-lg-4 p-0" --}}class="__translation">
                    <input class="inputForm w-100" type="text" name="province" placeholder=" " value="{{ old('province') }}">
                    <span>Provincia</span>
                    @error('province')<span class="errors">{{ $message }}</span> @enderror
                </div>
                <div {{-- class="col-lg-4 p-0" --}}class="__translation">
                    <input class="inputForm w-100" type="text" name="zip_code" placeholder=" " value="{{ old('zip_code') }}">
                    <span>Código postal</span>
                    @error('zip_code')<span class="errors">{{ $message }}</span> @enderror
                </div>

        </div>

        <div class="row d-flex flex-row" >
            <div class="__translation">
                <input class="inputForm w-100" type="text" name="shipment" placeholder=" " value="{{ old('shipment') }}">
                <span>Nombre del transporte</span>
                @error('shipment')<span class="errors">{{ $message }}</span> @enderror
            </div>
            {{-- <div class="col-lg-12 d-flex justify-content-between p-0">
                <div class="col-lg-6 p-0">
                    <input class="inputForm w-100" type="text" name="zip_code" placeholder="Código postal" value="{{ old('zip_code') }}">
                    @error('zip_code')<span class="errors">{{ $message }}</span> @enderror
                </div>
                <div class="col-lg-6 p-0">
                    <input class="inputForm w-100" type="text" name="shipment" placeholder="Nombre del transporte" value="{{ old('shipment') }}">
                    @error('shipment')<span class="errors">{{ $message }}</span> @enderror
                </div>
            </div> --}}
        </div>

        <div class="row d-flex flex-row">
            <div class="d-flex justify-content-between p-0">
                <div class="p-0 m-0" style="width: 49%">
                    <select class="inputForm w-100" name="tipo_iva" id="tipo_iva" onchange="checkTipoIva()">
                        <option value="ri">RI</option>
                        <option value="mt">Monotributo</option>
                        <option value="cf">CF</option>
                    </select>
                </div>
                <div id="cuit" class="p-0 m-0 __translation" style="width: 49%;position: relative">
                    <input class="inputForm w-100" type="text"  name="cuit" placeholder=" " value="{{ old('cuit') }}">
                    <span>Nro CUIT</span>
                    @error('cuit')<span class="errors">{{ $message }}</span> @enderror
                </div>
                <div id="dni" class="p-0 m-0 __translation" style="width: 49%;position: relative">
                    <input class="inputForm w-100" type="text"  name="dni" placeholder=" " value="{{ old('dni') }}">
                    <span>Nro DNI</span>
                    @error('dni')<span class="errors">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>


        <div class="row d-flex flex-row">
            <div class="d-flex justify-content-between p-0">
                <div class="p-0 m-0 __translation" style="width:49%;position: relative;">
                    <input required class="inputForm w-100" type="text" name="email" placeholder=" " value="{{ old('email') }}">
                    <span>Correo electrónico</span>
                    @error('email')<span class="errors"> {{ $message }}</span> @enderror
                </div>
                <div class="p-0 m-0 __translation" style="width:49%;position: relative;">
                    <input class="inputForm w-100" type="text" name="phone" placeholder=" " value="{{ old('phone') }}">
                    <span>Teléfono</span>
                    @error('phone')<span class="errors">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>


        <div class="row d-flex flex-row">
            <div class="d-flex justify-content-between p-0">
                <div class="p-0 m-0 __translation" style="width:49%;position: relative;">
                    <input required id="password" type="password" class="inputForm w-100 @error('password') is-invalid @enderror" name="password" placeholder = ' ' autocomplete="new-password">
                    <span>Password</span>
                    @error('password')<span class="errors"> {{ $message }}</span> @enderror
                </div>
                <div class="p-0 m-0 __translation" style="width:49%;position: relative;">
                    <input required id="password-confirm" type="password" class="inputForm w-100" name="pasword_confirmation" placeholder = ' ' autocomplete="new-password">
                    <span>Confirmá la password</span>
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
