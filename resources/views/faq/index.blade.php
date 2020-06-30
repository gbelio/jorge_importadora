@extends('layouts.master')
@section('content')

<main class="faq">
    <div class="cajita3"></div>
    <h1>Preguntas Frecuentes</h1>  
    <div class="boxes">
        <div class="left">
            <h3>¿Qué servicios ofrece el sito web y cuánto cuestan?</h3>
            <p>{{$wordingsFaq['servicios']}}</p>
            <h3>¿Cómo funciona el intercambio de objetos?</h3>
            <p>{{$wordingsFaq['intercambio']}}</p>
            <h3>¿Puedo realizar una compra en vez de un trueque?</h3>
            <p>{{$wordingsFaq['compraTrueque']}}}</p>
            <h3>¿Cómo realizar una denuncia?
                <div class="adm"> 
                    <img src="img/admiration_marc-01.svg" alt="admiration_marc"> 
                </div>
            </h3>        
            <p>{{$wordingsFaq['denuncia']}}}</p>
        </div>
        <div class="right">
            <h3>¿Cómo reconocer a un usuario destacado?
            <div class="cool"> 
                <img src="img/cool-01.svg" alt="cool"> 
            </div>
            </h3>
            <p>{{$wordingsFaq['usuarioDestacado']}}}</p>
            <h3>Penalidades</h3>
            <p>{{$wordingsFaq['penalidades']}}</p>
            <h3>Restricciones</h3>
            <p>{{$wordingsFaq['restricciones']}}</p>
        </div>
    </div>
</main>

@endsection
