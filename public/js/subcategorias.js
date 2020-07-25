$(document).ready(function(){
    if ($('#subcategory_id').val() == null){
        document.getElementById('subcategory_id').disabled=true;
    }
    function loadSubcats(){
        var category_id = $('#category_id').val();
        if($.trim(category_id) != ''){
            $.get('/subcategorias/index', {category_id : category_id}, function(subcategories){
                var old = $('#subcategory_id').val() != '' ? $('#subcategory_id').val() : '';
                $('#subcategory_id').empty();
                $('#subcategory_id').append("<option value='' disabled>Seleccione una subcategoría</option>");
                $.each(subcategories, function (index, value){
                    $('#subcategory_id').append("<option value='" + index + "'" + (old == index ? 'selected' : '') + ">" + value + "</option>");
                })
            });
        }
    }
    loadSubcats();
    $('#category_id').on('change', loadSubcats);
    $('#category_id').on('change', function(){
        document.getElementById('subcategory_id').disabled=false;
    })
});