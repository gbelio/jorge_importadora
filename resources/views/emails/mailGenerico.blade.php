@component('mail::message')



# {{ $titulo }}



{!! $cuerpo !!}

<div style="text-align: center;">
    <div>
        <a href="https://api.whatsapp.com/send?phone=541124772468"><img class="phone-footer" src="http://www.importadorajorge.com.ar/img/whatsapp.svg')" alt="whatsapp"></a>
    </div>
</div>

@endcomponent