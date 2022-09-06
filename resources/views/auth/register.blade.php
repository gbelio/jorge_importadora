@extends('layouts.master')
@section('content')

<div class="container1">
  <main class="register">
    <div class="cajita2">

      <h1 class="inicioSesion">Registro!</h1>

      <form class="formularioRegister" action="{{action('UserController@store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input class="inputForm" type="text" name="name" placeholder="Nombre"
          value="{{ old('name') }}">
        @error('name')
        <span class="errors">{{ $message }}</span>
        @enderror
        <input class="inputForm" type="text" name="last_name" placeholder="Apellido" value="{{ old('last_name') }}">
        @error('last_name')
        <span class="errors">{{ $message }}</span>
        @enderror
        <input class="inputForm" type="text" name="phone" placeholder="Teléfono" value="{{ old('phone') }}">
        @error('phone')
        <span class="errors">{{ $message }}</span>
        @enderror
        <input class="inputForm" type="text" name="email" placeholder="Correo electrónico"
          value="{{ old('email') }}">
        @error('email')
        <span class="errors"> {{ $message }}</span>
        @enderror
        <input class="inputForm" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder = 'Password' autocomplete="new-password">
        @error('password')
        <span class="errors"> {{ $message }}</span>
        @enderror
        <input class="inputForm" id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder = 'Confirma la password' autocomplete="new-password">
        @error('password')
        <span class="errors"> {{ $message }}</span>
        @enderror

        <br>

        <div class="divSubmitLogin">
          <button class="botonLogin" type="submit" name="submit">{{ __('Enviar') }}</button>
        </div>

      </form>
    </div>
  </main>
</div>

@endsection
