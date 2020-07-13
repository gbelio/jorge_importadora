$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //producto
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


    //categoría
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


    //subcategoría
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

    
    
})