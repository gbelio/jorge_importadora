function deleteData($id){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }),
    function(){
        $.ajax({
            url: '/productos/edit/'+id,
            type: 'POST',
            data: {id:id},
            success: function(){
                Swal.fire(
                    'Editado!',
                    'Tu registro ha sido editado correctamente',
                    'success'
                    )
                .then ((result) => {
                    location.reload();
                });
            }
        })
    }
}