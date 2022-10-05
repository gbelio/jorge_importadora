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
                <input id="name" class="inputForm w-100" required type="text" name="name" placeholder=" " value="{{ old('name') }}">
                <label for="name">Nombre</label>
                @error('name')<span class="errors">{{ $message }}</span> @enderror
            </div>
            <div class="__translation">
                <input id="last_name" class="inputForm w-100" type="text" name="last_name" placeholder=" " value="{{ old('last_name') }}">
                <label for="last_name">Apellido</label>
                @error('last_name')<span class="errors">{{ $message }}</span> @enderror
            </div>
            <div class="__translation">
                <input id="business_name" class="inputForm w-100" type="text" name="business_name" placeholder=" " value="{{ old('business_name') }}">
                <label for="business_name">Razón social</label>
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
                <input id="address" class="inputForm w-100" type="text" name="address" placeholder=" " value="{{ old('address') }}">
                <label for="address">Dirección</label>
                @error('address')<span class="errors">{{ $message }}</span> @enderror
            </div>
               {{--  <div class="col-lg-4 p-0">
                    <input class="inputForm w-100" type="text" name="address" placeholder="Dirección" value="{{ old('address') }}">
                    @error('address')<span class="errors">{{ $message }}</span> @enderror
                </div> --}}
                <div {{-- class="col-lg-4 p-0" --}} class="__translation">
                    <input id="department" class="inputForm w-100" type="text" name="department" placeholder=" " value="{{ old('department') }}">
                    <label for="department">Localidad</label>
                    @error('department')<span class="errors">{{ $message }}</span> @enderror
                </div>
                <div {{-- class="col-lg-4 p-0" --}}class="__translation">
                    <input id="province" class="inputForm w-100" type="text" name="province" placeholder=" " value="{{ old('province') }}">
                    <label for="province">Provincia</label>
                    @error('province')<span class="errors">{{ $message }}</span> @enderror
                </div>
                <div {{-- class="col-lg-4 p-0" --}}class="__translation">
                    <input id="zip_code" class="inputForm w-100" type="text" name="zip_code" placeholder=" " value="{{ old('zip_code') }}">
                    <label for="zip_code">Código postal</label>
                    @error('zip_code')<span class="errors">{{ $message }}</span> @enderror
                </div>

        </div>

        <div class="row d-flex flex-row" >
            <div class="__translation">
                <input id="shipment" class="inputForm w-100" type="text" name="shipment" placeholder=" " value="{{ old('shipment') }}">
                <label for="shipment">Nombre del transporte</label>
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
                    <input id="CUIT" class="inputForm w-100" type="text"  name="cuit" placeholder=" " value="{{ old('cuit') }}">
                    <label for="CUIT" style="left: 12px;">Nro CUIT</label>
                    @error('cuit')<span class="errors">{{ $message }}</span> @enderror
                </div>
                <div id="dni" class="p-0 m-0 __translation" style="width: 49%;position: relative">
                    <input id="DNI" class="inputForm w-100" type="text"  name="dni" placeholder=" " value="{{ old('dni') }}">
                    <label for="DNI" style="left: 12px;">Nro DNI</label>
                    @error('dni')<span class="errors">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>


        <div class="row d-flex flex-row">
            <div class="d-flex justify-content-between p-0">
                <div class="p-0 m-0 __translation" style="width:49%;position: relative;">
                    <input id="email" required class="inputForm w-100" type="text" name="email" placeholder=" " value="{{ old('email') }}">
                    <label for="email" style="left: 12px;">Correo electrónico</label>
                    @error('email')<span class="errors"> {{ $message }}</span> @enderror
                </div>
                <div class="p-0 m-0 __translation" style="width:49%;position: relative;">
                    <input id="phone" class="inputForm w-100" type="text" name="phone" placeholder=" " value="{{ old('phone') }}">
                    <label for="phone" style="left: 12px;">Teléfono</label>
                    @error('phone')<span class="errors">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>


        <div class="row d-flex flex-row">
            <div class="d-flex justify-content-between p-0">
                <div class="p-0 m-0 __translation" style="width:49%;position: relative;">
                    <input required id="pw" type="password" class="inputForm w-100 @error('password') is-invalid @enderror" name="password" placeholder = ' ' autocomplete="new-password">
                    <label for="pw" style="left: 12px;">Password</label>
                    @error('password')<span class="errors"> {{ $message }}</span> @enderror
                </div>
                <div class="p-0 m-0 __translation" style="width:49%;position: relative;">
                    <input required id="pw-confirm" type="password" class="inputForm w-100" name="pasword_confirmation" placeholder = ' ' autocomplete="new-password">
                    <label for="pw-confirm" style="left: 12px;">Confirmá la password</label>
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
