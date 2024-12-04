$(document).ready(function(){
    $('#select_product89').on('change',function(){
        const product_id = $(this).val()
        console.log(product_id);
        if(product_id){
            $.ajax({
                url:'get_data_product.php',
                type:'GET',
                data:{product_id:product_id},
                dataType:'json',
                success:function(response){
                    $('#new_product_price').val(response.price)
                    
                },
                error:function(jqXHR, textStatus, errorThrown){
                    console.error('Error en la petición AJAX:', textStatus, errorThrown, jqXHR.responseText);
                    alert('Error consiguiendo precio')
                }
                 
            })
        }
    })
})