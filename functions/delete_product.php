<?php
include 'conexion_be.php';
include 'functions.php';

session_start();




// Validar que el formulario fue enviado y que un producto fue seleccionado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product']) && !empty($_POST['product'])) {
    // Recuperar el id del producto
    $product_id = $_POST['product'];

    // Escapar el id para evitar inyecciones SQL
    $product_id = mysqli_real_escape_string($conexion, $product_id);

    // Obtener información del producto antes de eliminarlo (opcional, para registro o validación adicional)
    $product_query = "SELECT nombre FROM productos WHERE id = $product_id";
    $product_result = mysqli_query($conexion, $product_query);
    
    if ($product_result && mysqli_num_rows($product_result) > 0) {
        $product = mysqli_fetch_assoc($product_result);
        $product_name = $product['nombre'];

        // Eliminar el producto
        $sql = "DELETE  FROM carrito WHERE id_producto = $product_id";

        $delete_query = "DELETE FROM productos WHERE id = $product_id";
        
        mysqli_query($conexion, $sql);
        if (mysqli_query($conexion, $delete_query)) {
            $_SESSION['message'] = "El producto '$product_name' ha sido eliminado exitosamente.";
            //redirigir a una página de lista de productos
            header('Location: ../admin.php');
        } else {
            $_SESSION['message'] = "Error al eliminar el producto: " . mysqli_error($conexion);
            header('Location: ../admin.php');
        }
    } else {
        $_SESSION['message'] = "El producto no existe o ya fue eliminado.";
        header('Location: ../admin.php');
    }
} else {
    $_SESSION['message'] = "Por favor selecciona un producto para eliminar.";
    header('Location: ../admin.php');
}

/*function delete_cart_item(){
    if($_SERVER['REQUEST_METHOD']=="POST"){
        //Obtiene el ID del producto
        $product_id = clean($_POST['product_id']);
        //Consulta para eliminar el producto del carrito según su ID
        $sql = "DELETE  FROM carrito WHERE id_producto = $product_id";
        $result = query($sql);
        //Comprueba si la eliminación fué exitosa
        if($result == 1){
            $_SESSION['message'] = "Se ha eliminado correctamente.";
        }else{
            $_SESSION['message'] = "No se pudo eliminar el producto.";
        }
        
        header('Location: cart.php');
        exit();
    }
}*/