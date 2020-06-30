@extends('layouts.master')
@section('content')

<main class="caja">
  <div class="container">
    <a href="#"><img src="img/banner_pick_your_treasure.svg" alt=""></a>
  </div>
  <section class="container1">
    @foreach($categorias as $categoria)
      @if($categoria->name === "Music")
        <a class="comon" href="categorias/{{$categoria->id}} ">
          <article class="art art1"></article>
        </a>
      @endif
    @endforeach
    @foreach($categorias as $categoria)
      @if($categoria->name === "Reading")
        <a class="comon" href="categorias/{{$categoria->id}}">
          <article class="art art2"></article>
        </a>
      @endif
    @endforeach
    <a class="hotstuff" href="categorias/hotstuff">
      <article class="art art3"></article>
    </a>
    @foreach($categorias as $categoria)
      @if($categoria->name === "Games")
        <a class="comon" href="categorias/{{$categoria->id}}">
          <article class="art art4"></article>
        </a>
      @endif
    @endforeach
    @foreach($categorias as $categoria)
      @if($categoria->name === "Other")
        <a class="comon" href="categorias/{{$categoria->id}}">
          <article class="art art5"></article>
        </a>
      @endif
    @endforeach
  </section>
  <section class="banner_publicidad">
    <h1 class="banner"> BANNER DE PUBLICIDAD </h1>
  </section>
</main>

@endsection