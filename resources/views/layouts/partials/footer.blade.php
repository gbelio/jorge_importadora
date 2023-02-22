<footer id="footer">
    <div class="main_box">
        <div class="marca">
            <div>
                <img src="/img/logo-horizontal--03.png" alt="logo">
            </div>
            <div>
                <div>
                    <img src="/img/location-footer.svg" alt="location">
                    <p>SARMIENTO 2444 CABA. CP 1044</p>
                </div>
                <div>
                    <img src="/img/mail_footer.svg" alt="mail">
                    <p>ventaswebij@gmail.com</p>
                </div>
                <div>
                    <img src="/img/phone_footer.svg" alt="phone">
                    <p> 011 4951-2236 / 011 4954-3060 </p>
                </div>
            </div>    
        </div>
        <div class="atencion">
            <div>
                <p>HORARIO DE ATENCIÓN:</p>
                <p>Lunes a Viernes de 8 a 17 horas.</p>
                <p>Sábado de 8 a 13 horas.</p>
            </div>
            <div>
                <div>
                    <img src="{{asset('img/whatsapp.svg')}}" alt="whatsapp">
                    <a href="https://api.whatsapp.com/send?phone=541124772468">+54 11 2477-2468</a>
                </div>
                <div>
                    <img src="{{asset('img/redes_facebook.svg')}}" alt="facebook">
                    <a class="contacto-img-footer" href="https://es-la.facebook.com/ImportadoraJorge/" target="_blank">ImportadoraJorge</a>
                </div>
            </div>
        </div>
        @isset($allCategories)
        <div class="categorias_footer">
            <p>CATEGORÍAS</p>
            @foreach ($allCategories as $category)
            <a href="/categorias/busqueda?clave={{$category->name}}" class="categorias_footer">{{$category->name}}</a>
            @endforeach
        </div>
        @endisset
    </div>
    <div class="rights">
        <div>© 2022 | Derechos reservados - IMPORTADORA JORGE</div>
        <img class="development_logo" src="/img/development_logo-01.svg" alt="logo_DiseñoDesarrolloProgramacion">
    </div>
</footer>
