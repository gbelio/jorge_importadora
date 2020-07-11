$(document).ready(function(){
    $("#botonFormProd").on( "click", function() {	 
        $("#botonFormProd1").css('display', 'block');
        $("#botonFormProd").css('display', 'none');
        $('#target').toggle('fast');
    });

    $("#botonFormProd1").on( "click", function() {	 
        $("#botonFormProd").css('display', 'block');
        $("#botonFormProd1").css('display', 'none');
        $('#target').toggle('fast');
    });
});