@extends('layouts.master')
@section('content')

<main class="register">
  <div class="cajita-texto">
    <h1>One man s trash is another man s treasure</h1>
    <p class="texto_bienvenida">
    <strong> VINTRASH </strong> es un espacio para que tú puedas buscar y
      encontrar, u ofrecer, todo aquello que te apasiona.
      Desde comics, libros, vinilos, cassettes, posters, figuras de
      colección en su empaque original, juegos, vhs, etc.
      Pequeñas o grandes reliquias, aquellas que para algunos
      quedaron en el olvido y que, para ti, son tesoros a encontrar.

      Las reglas son simples, somos un <strong>ecommerce de “intercambio”</strong>: solicitas un producto, el oferente ingresa a tu
      perfil y revisa si hay algo de su interés y, si lo encuentra,
      intercambian productos. <br>
      <b>Pero no te desanimes!</b> Si no tienes nada que ofrecer, que
      sea de interés para tu ofertante, el puede subastártelo!
      <br>
      <b> <i> Bienvenido a VINTRASH, donde el desecho de uno es
      el tesoro de otro. </i> </b>
    </p>
  </div>
  <div class="cajita2">    
    @if(count($errors)>0)
      <span>
          <img class='boom' src="{{asset('img/BOOM-01.svg')}}" alt="rompiste todo vieja" width=30%>
      </span>  
    @endif
    <h1>Registro!</h1>
    <form class="formularioRegister" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input class="inputForm" type="text" name="name" placeholder="Usuario"
        value="{{ old('name') }}">    
      @error('name')
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
      <div class="button">
        <p>Agrega tu Avatar</p>
        <input class="avatar" type="file" name="avatar" value="{{ old('avatar') }}" />
      </div>
      @error('avatar')
      <span class="errors errors2"> {{ $message }}</span>
      @enderror
      <p class="ldob" for="DOB">Fecha de Nacimiento</p>
      <input type="date" name="dob" style="margin-top:-10%;">    
      @error('dob')
      <span class="errors">{{ $message }}</span>
      @enderror
      <br>
      <button class="submitRegister" type="submit" name="submit" style="margin-top:10%;">{{ __('Enviar') }}</button>
    </form>
  </div>
</main>

@endsection