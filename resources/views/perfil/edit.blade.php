@extends('layouts.master')
@section('content')
<section class="container">
    <article class="col-lg-5">
        <h2 class="">Editar Perfil:</h2>
        <h3>{{ $user->name }}</h3>
        <form class="" action="{{action('ProfileController@update')}}" method="POST" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            @csrf
            <div class="form-group">
                <label for="Nombre">Usuario</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <label type="email" name="email" value="" class="form-control">{{ $user->email }}</label>
            </div>
            <div class="form-group">
                <label for="Password">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
            </div>
            <div class="form-group">
                <label for="repassword">Confirmar Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-info" value="Confirmar Cambios">
            </div>
        </form>
    </article>
</section>
@endsection