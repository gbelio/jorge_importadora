$(document).ready(function(){

    //Cantidad de categorías
    let categoriesCount = parseInt($('#categories-count').val());
    let categoriesIds = jQuery.parseJSON($('#categories_ids').val());

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

    for(let i = 0; i < categoriesCount; i++){

        let next_button = $('.am-next'+i);
        let prev_button = $('.am-prev'+i);

        $('#cat'+categoriesIds[i].id+'>.owl-carousel').owlCarousel({
            items: 4,
            margin:15,
            nav:true,
            responsiveClass:true,
            responsive: {
                0:{
                    items: 1,
                    margin:15,
                    navText: [next_button,prev_button],
                    nav:true,
                    dots: false,
                },
                500:{
                    items: 2,
                    margin:15,
                    navText: [next_button,prev_button],
                    nav:true,
                    dots: false,
                },
                750:{
                    items: 3,
                    margin:15,
                    navText: [next_button,prev_button],
                    nav:true,
                    dots: false,
                },
                1024:{
                    items: 4,
                    margin:15,
                    navText: [next_button,prev_button],
                    nav:true,
                    dots: false,
                }
            }
        })
    }

    let cajaGrande = $('.item');

	cajaGrande.each(function(){
        $(this).hover(boxShadowOn,boxShadowOff);
    });

})


function boxShadowOn(){
    $(this).css('boxShadow', ' 0px 0px 4px 1px rgba(0,0,0,0.45)')
        .css('transition', '200ms')
        .css('cursor', 'pointer')
}

function boxShadowOff(){
    $(this).css('boxShadow', '0px 0px 4px 0px rgba(0, 0, 0, 0)')
        .css('transition', '200ms')
}


