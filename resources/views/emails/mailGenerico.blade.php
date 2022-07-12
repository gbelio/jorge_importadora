@component('mail::message')



# {{ $titulo }}



{!! $cuerpo !!}

<div style="text-align: center;">
    <div>
        <a href="https://api.whatsapp.com/send?phone=541124772468">
            <img  style="width: 36px;padding-bottom: 8px;padding-right: 10px;" src="https://logodownload.org/wp-content/uploads/2015/04/whatsapp-logo-3-1.png" alt="whatsapp">
        </a>
        <a class="contacto-img-footer" href="https://es-la.facebook.com/ImportadoraJorge/" target="_blank" >
            <img style="width: 35px;padding-bottom: 10px;padding-right: 10px;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Facebook_f_logo_%282019%29.svg/1365px-Facebook_f_logo_%282019%29.svg.png" alt="facebook">
        </a>
    </div>
</div>

@endcomponent