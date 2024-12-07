$(document).ready(function() {
    // Cuando el DOM esté completamente cargado, ejecuta este código.
    
    $('#select_product89').on('change', function() {
        // Captura el evento 'change' del elemento <select> con ID 'select_product89'.
        const product_id = $(this).val(); 
        // Obtiene el valor seleccionado del <select> y lo almacena en la variable 'product_id'.
        console.log(product_id);
        // Muestra en la consola el ID del producto seleccionado para depuración.

        if (product_id) {
            // Verifica si 'product_id' tiene un valor válido (no vacío o nulo).
            
            $.ajax({
                url: 'get_data_product.php', // Archivo PHP que procesará la solicitud.
                type: 'GET', // Tipo de solicitud HTTP (GET en este caso).
                data: { product_id: product_id }, // Datos enviados al servidor: el ID del producto.
                dataType: 'json', // Tipo de dato esperado como respuesta: JSON.
                
                success: function(response) {
                    // Función que se ejecuta si la solicitud AJAX es exitosa.
                    $('#new_product_price').val(response.price);
                    // Actualiza el valor del campo de entrada con ID 'new_product_price'
                    // con el precio obtenido del servidor (contenido en 'response.price').
                },
                
                error: function(jqXHR, textStatus, errorThrown) {
                    // Función que se ejecuta si la solicitud AJAX falla.
                    console.error(
                        'Error en la petición AJAX:', 
                        textStatus, 
                        errorThrown, 
                        jqXHR.responseText
                    );
                    // Imprime detalles del error en la consola para facilitar depuración.
                    
                    alert('Error consiguiendo precio');
                    // Muestra un mensaje de alerta al usuario indicando que hubo un error.
                }
            });
        }
    });
});