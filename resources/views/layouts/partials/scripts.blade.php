<script>
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
</script>

<script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/carousel.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/modal.js')}}"></script>
<script src="{{asset('js/slider.js')}}"></script>
<script src="{{asset('js/toggle.js')}}"></script>
<script src="{{asset('js/alert.js')}}"></script>
<script src="{{asset('js/subcategorias.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script>
CKEDITOR.config.height = 400;
CKEDITOR.config.width = 'auto';
CKEDITOR.replace('description');
</script>