$(document).ready(function(){

    let siguienteCarrousel = $('.siguienteCarrousel');
    let anteriorCarrousel = $('.anteriorCarrousel');

    $('#sliderHome>.owl-carousel').owlCarousel({
        items:1,
        margin:0,
        navText: [siguienteCarrousel,anteriorCarrousel],
        nav:true,
        dots: true,
        loop:true,
        autoplay: true,
        autoplayTimeout:3000,
    })

    for(let i = 0; i < 14; i++){

        let full_items = 4;
        let items_responsive_0_600 = 1;
        let items_responsive_600_1000 = 2;

        let next_button = $('.am-next'+i);
        let prev_button = $('.am-prev'+i);

        $('#cat'+i+'>.owl-carousel').owlCarousel({
            items: full_items,
            margin:15,
            navText: [next_button,prev_button],
            nav:true,
            dots: false,
            responsiveClass:true,
            responsive: {
                0:{
                    items: items_responsive_0_600,
                    margin:15,
                    navText: [next_button,prev_button],
                    nav:true,
                    dots: false,
                },
                600:{
                    items: items_responsive_600_1000,
                    margin:15,
                    navText: [next_button,prev_button],
                    nav:true,
                    dots: false,
                },
                1000:{
                    items: full_items,
                    margin:15,
                    navText: [next_button,prev_button],
                    nav:true,
                    dots: false,
                }
            }
        })
    }

    let cajaGrande = $('.item');

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
