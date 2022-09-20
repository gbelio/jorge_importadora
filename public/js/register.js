$(document).ready(function() {
    disableTipoIva();
    checkTipoIva();
});

function disableTipoIva(){
    $('#cuit').css('display', 'none');
    $('#dni').css('display', 'none');
}

function checkTipoIva(){
    let cuit = $('#cuit');
    let dni = $('#dni');
    let tipo_iva = $('#tipo_iva').val();

    if(tipo_iva === 'ri' || tipo_iva === 'mt'){
        cuit.css('display', 'block');
        dni.css('display', 'none');
    }

    if(tipo_iva === 'cf'){
        dni.css('display', 'block');
        cuit.css('display', 'none');
    }
}

