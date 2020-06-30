@extends('layouts.master')
@section('content')

<main class="login">
  <div class="cajita">    
  @if(count($errors)>0)
    <img src="img/crash-01.svg" alt="rompiste_todo_mach@" width=40%>
  @endif  
    <h1>Inicio sesion!</h1>   
    <form method="POST" action="{{ route('login') }}" class="formulario-login">
      @csrf
      <input class="inputLogin" id="email" type="email" placeholder="Email" class="form-control 
      @error('email') 
      is-invalid 
      @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
      @error('email')
        <span class="errors">{{ $message }}</span>
      @enderror      
      <input class="inputLogin" id="password" type="password" placeholder = 'Password' class="form-control 
      @error('password') 
      is-invalid 
      @enderror" name="password" autocomplete="current-password">
      @error('password')
        <span class="errors">{{ $message }}</span>
      @enderror
      @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Olvidaste tu password?') }}
        </a>
      @endif
      <p>Recordarme
        <input class="inputLogin" class="check" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
      </p>
      <button class="submitLogin" type="submit">{{ __('Enviar') }}</button>
    </form>
  </div>
</main>

@endsection