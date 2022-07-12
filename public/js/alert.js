$(document).ready(function(){

    //TOKEN AJAX (NECESARIO SIEMPRE)

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //FIN TOKEN AJAX

    /* -------------------------------------------------------------------------- */
    //CONFIRMACIÓN DE COMPRA
    $("tr td form #buy").click(function(ev){
        ev.preventDefault();
        var id = $(this).parents('tr').find('.order_id').val();
        var order_total = $(this).parents('tr').find('.order_total').val();
        
        Swal.fire({
            title: '¿Realmente quieres confirmar esta orden de compra?',
            text: "Una vez enviada la orden de compra no podrá ser modificada de manera virtual, deberá contactar al vendedor.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
            }).then((result) => {
            if (result.value) {

                var data = {
                    "_token" : $('input[name=_token]').val(),
                    "order_id" : id,
                    "order_total": order_total,
                };
                console.log(data);
                $.ajax({
                    type: 'PATCH',
                    url: '/status',
                    data: data,
                    success: function(response){

                        Swal.fire(
                            'Enviado!',
                            'Tu orden ha sido procesada.',
                            'success'
                          )
                        .then ((result) => {
                            location.replace('/');
                        });
                    }
                })
            }
        })
    })

    //CONFIRMACIÓN BORRAR

    //Producto (abm)
    $("tr td #delete").click(function(ev){
        ev.preventDefault();
        var nombre = $(this).parents('tr').find('td:nth-child(2)').text();
        var id = $(this).parents('tr').find('.serdelete_val_id').val();

        Swal.fire({
            title: '¿Realmente quieres eliminar el registro de '+nombre+' ?',
            text: "El registro será eliminado permanentemente",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrar',
            cancelButtonText: 'No',
            }).then((result) => {
            if (result.value) {

                var data = {
                    "_token" : $('input[name=_token]').val(),
                    "id" : id,
                };

                $.ajax({
                    type: 'DELETE',
                    url: '/productos/delete/'+id,
                    data: data,
                    success: function(response){

                        Swal.fire(
                            'Eliminado!',
                            'Tu registro ha sido eliminado correctamente',
                            'success'
                          )
                        .then ((result) => {
                            location.reload();
                        });
                    }
                })
            }
        })
    })

    //Categoría (abm)
    $("tr td #delete1").click(function(ev){
        ev.preventDefault();
        var nombre = $(this).parents('tr').find('td:nth-child(2)').text();
        var id = $(this).parents('tr').find('.serdelete_val_id1').val();

        Swal.fire({
            title: '¿Realmente quieres eliminar el registro de '+nombre+' ?',
            text: "El registro será eliminado permanentemente",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrar',
            cancelButtonText: 'No',
            }).then((result) => {

                if (result.value) {

                    var data = {
                        "_token" : $('input[name=_token]').val(),
                        "id" : id,
                    };

                    $.ajax({
                        type: 'DELETE',
                        url: '/categorias/delete/'+id,
                        data: data,

                    })

                    .done(function(response){
                        Swal.fire(
                            'Eliminado!',
                            'Tu registro ha sido eliminado correctamente',
                            'success'
                        )
                        .then ((result) => {
                            location.reload();
                        });
                    }).fail (function(response){
                        Swal.fire(
                            'Ups!',
                            'Tu registro no se pudo eliminar, esta siendo utilizado por una subcategoría o un producto',
                            'error'
                        )

                    })
                }
            })
    })

    //Subcategoría (abm)
    $("tr td #delete2").click(function(ev){
        ev.preventDefault();
        var nombre = $(this).parents('tr').find('td:nth-child(2)').text();
        var id = $(this).parents('tr').find('.serdelete_val_id2').val();


        Swal.fire({
            title: '¿Realmente quieres eliminar el registro de '+nombre+' ?',
            text: "El registro será eliminado permanentemente",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrar',
            cancelButtonText: 'No',
            }).then((result) => {
            if (result.value) {

                var data = {
                    "_token" : $('input[name=_token]').val(),
                    "id" : id,
                };

                $.ajax({
                    type: 'DELETE',
                    url: '/subcategorias/delete/'+id,
                    data: data,

                })
                .done(function(response){
                    Swal.fire(
                        'Eliminado!',
                        'Tu registro ha sido eliminado correctamente',
                        'success'
                    )
                    .then ((result) => {
                        location.reload();
                    });
                }).fail (function(response){
                    Swal.fire(
                        'Ups!',
                        'Tu registro no se pudo eliminar, esta siendo utilizado por un producto',
                        'error'
                    )

                })
            }
        })
    })

    //Producto (showAll)
    $("form #delete4").click(function(ev){
        ev.preventDefault();
        var nombre = $(this).parents('#_form_eliminar').find('.serdelete_val_id5').val();
        var id = $(this).parents('#_form_eliminar').find('.serdelete_val_id4').val();

        console.log(id);

        Swal.fire({
            title: '¿Realmente quieres eliminar el registro de '+nombre+' ?',
            text: "El registro será eliminado permanentemente",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrar',
            cancelButtonText: 'No',
            }).then((result) => {
            if (result.value) {

                var data = {
                    "_token" : $('input[name=_token]').val(),
                    "id" : id,
                };

                $.ajax({
                    type: 'DELETE',
                    url: '/productos/delete/'+id,
                    data: data,
                    /* success: function(response){

                        Swal.fire(
                            'Eliminado!',
                            'Tu registro ha sido eliminado correctamente',
                            'success'
                          )
                        .then ((result) => {
                            location.reload();
                        });
                    } */

                })
                .done(function(response){
                    Swal.fire(
                        'Eliminado!',
                        'Tu registro ha sido eliminado correctamente',
                        'success'
                    )
                    .then ((result) => {
                        location.reload();
                    });
                }).fail (function(response){
                    Swal.fire(
                        'Ups!',
                        'Tu registro no se pudo eliminar',
                        'error'
                    )

                })
            }
        })
    })

    //Slider (abm)
    $("form #delete5").click(function(ev){
        ev.preventDefault();
        var nombre = $(this).parents('td').find('.serdelete_val_id5').val();
        var id = $(this).parents('td').find('.serdelete_val_id5').val();

        Swal.fire({
            title: '¿Realmente quieres eliminar el registro de '+nombre+' ?',
            text: "El registro será eliminado permanentemente",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrar',
            cancelButtonText: 'No',
            }).then((result) => {
            if (result.value) {

                var data = {
                    "_token" : $('input[name=_token]').val(),
                    "id" : id,
                };

                $.ajax({
                    type: 'DELETE',
                    url: '/slider/delete/'+id,
                    data: data,

                })
                .done(function(response){
                    Swal.fire(
                        'Eliminado!',
                        'Tu registro ha sido eliminado correctamente',
                        'success'
                    )
                    .then ((result) => {
                        location.reload();
                    });
                }).fail (function(response){
                    Swal.fire(
                        'Ups!',
                        'Tu registro no se pudo eliminar',
                        'error'
                    )

                })
            }
        })
    })

    //Producto (Editar Producto Individual)
    $("form #delete6").click(function(ev){
        ev.preventDefault();
        var nombre = $(this).parents('form').find('.serdelete_val_id_7').val();
        var id = $(this).parents('form').find('.serdelete_val_id_6').val();

        Swal.fire({
            title: '¿Realmente quieres eliminar el registro de '+nombre+' ?',
            text: "El registro será eliminado permanentemente",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrar',
            cancelButtonText: 'No',
            }).then((result) => {
            if (result.value) {

                var data = {
                    "_token" : $('input[name=_token]').val(),
                    "id" : id,
                };

                $.ajax({
                    type: 'DELETE',
                    url: '/productos/delete/'+id,
                    data: data,
                })
                .done(function(response){
                    Swal.fire(
                        'Eliminado!',
                        'Tu registro ha sido eliminado correctamentee',
                        'success'
                    )
                    .then ((result) => {
                        location.assign("http://127.0.0.1:8000/productos")
                    });

                    }).fail (function(response){
                        Swal.fire(
                            'Ups!',
                            'Tu registro no se pudo eliminar',
                            'error'
                    )

                })
            }
        })
    })

    //Color (abm)
    $("tr td #delete7").click(function(ev) {
        ev.preventDefault();
        var nombre = $(this).parents('tr').find('td:nth-child(2)').text();
        var id = $(this).parents('tr').find('.serdelete_val_id7').val();

        Swal.fire({
            title: '¿Realmente quieres eliminar el registro de ' + nombre + ' ?',
            text: "El registro será eliminado permanentemente",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrar',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.value) {

                var data = {
                    "_token": $('input[name=_token]').val(),
                    "id": id,
                };

                $.ajax({
                    type: 'DELETE',
                    url: '/colores/delete/' + id,
                    data: data,
                    success: function (data) {
                        if(data !== ''){
                            Swal.fire(
                                'Eliminado!',
                                'Tu registro ha sido eliminado correctamentee',
                                'success'
                            ).then ((result) => {
                                location.reload();
                            });
                        }else{
                            Swal.fire(
                                'Ups!',
                                'Tu registro no se pudo eliminar, esta siendo utilizado por una producto',
                                'error'
                            )
                        }
                    },
                })
            }
        });
    });
    //FIN BORRAR



});
