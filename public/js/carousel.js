$(document).ready(function(){

    $('#sliderHome>.owl-carousel').owlCarousel({
        items:1,
        margin:0,
        navText: [$('.siguienteCarrousel'),$('.anteriorCarrousel')],
        nav:true,
        dots: true,
        loop:true,
        autoplay: true,
        autoplayTimeout:3000,
    })

    $('#cat1>.owl-carousel').owlCarousel({
        items:4,
        margin:15,
        navText: [$('.am-next1'),$('.am-prev1')],
        nav:true,
        dots: false,
    })

    $('#cat2>.owl-carousel').owlCarousel({
        items:4,
        margin:15,
        navText: [$('.am-next2'),$('.am-prev2')],
        nav:true,
        dots: false,
    })

    $('#cat3>.owl-carousel').owlCarousel({
        items:4,
        margin:15,
        navText: [$('.am-next3'),$('.am-prev3')],
        nav:true,
        dots: false,
    })
    $('#cat4>.owl-carousel').owlCarousel({
        items:4,
        margin:15,
        navText: [$('.am-next4'),$('.am-prev4')],
        nav:true,
        dots: false,
    })

    $('#cat5>.owl-carousel').owlCarousel({
        items:4,
        margin:15,
        navText: [$('.am-next5'),$('.am-prev5')],
        nav:true,
        dots: false,
    })

    $('#cat6>.owl-carousel').owlCarousel({
        items:4,
        margin:15,
        navText: [$('.am-next6'),$('.am-prev6')],
        nav:true,
        dots: false,
    })

    $('#cat7>.owl-carousel').owlCarousel({
        items:4,
        margin:15,
        navText: [$('.am-next7'),$('.am-prev7')],
        nav:true,
        dots: false,
    })

    $('#cat8>.owl-carousel').owlCarousel({
        items:4,
        margin:15,
        navText: [$('.am-next8'),$('.am-prev8')],
        nav:true,
        dots: false,
    })

    $('#cat9>.owl-carousel').owlCarousel({
        items:4,
        margin:15,
        navText: [$('.am-next9'),$('.am-prev9')],
        nav:true,
        dots: false,
    })

    $('#cat10>.owl-carousel').owlCarousel({
        items:4,
        margin:15,
        navText: [$('.am-next10'),$('.am-prev10')],
        nav:true,
        dots: false,
    })

    $('#cat11>.owl-carousel').owlCarousel({
        items:4,
        margin:15,
        navText: [$('.am-next11'),$('.am-prev11')],
        nav:true,
        dots: false,
    })

    $('#cat12>.owl-carousel').owlCarousel({
        items:4,
        margin:15,
        navText: [$('.am-next12'),$('.am-prev12')],
        nav:true,
        dots: false,
    })

    $('#cat13>.owl-carousel').owlCarousel({
        items:4,
        margin:15,
        navText: [$('.am-next13'),$('.am-prev13')],
        nav:true,
        dots: false,
    })

    $('#cat14>.owl-carousel').owlCarousel({
        items:4,
        margin:15,
        navText: [$('.am-next14'),$('.am-prev14')],
        nav:true,
        dots: false,
    })

    $('#cat15>.owl-carousel').owlCarousel({
        items:4,
        margin:15,
        navText: [$('.am-next15'),$('.am-prev15')],
        nav:true,
        dots: false,
    })

    var cajaGrande = $('.item');

    function boxShadowOn(){
        $(this).css('boxShadow', ' 0px 0px 4px 1px rgba(0,0,0,0.45)')
        $(this).css('transition', '200ms')
        $(this).css('cursor', 'pointer')
	}

	function boxShadowOff(){
        $(this).css('boxShadow', '0px 0px 4px 0px rgba(0, 0, 0, 0)')
                .css('transition', '200ms')
    }


	cajaGrande.each(function(){
        $(this).hover(boxShadowOn,boxShadowOff);
    });

})
