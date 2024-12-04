<?php
include 'conexion_be.php'; // Archivo para conectar a la base de datos
include 'functions.php';  // Si tienes funciones adicionales
session_start();

// Validar que el formulario se haya enviado correctamente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product']) && !empty($_POST['product']) && isset($_POST['preparations'])) {
    // Escapar el id del producto
    $product_id = mysqli_real_escape_string($conexion, $_POST['product']);

    // Preparaciones seleccionadas
    $preparations = $_POST['preparations']; // Esto es un array

    // Validar que sea un array y que no esté vacío
    if (is_array($preparations) && count($preparations) > 0) {
        $errors = [];

        foreach ($preparations as $preparation_id) {
            // Escapar cada id de preparación
            $preparation_id = mysqli_real_escape_string($conexion, $preparation_id);

            // Comprobar si ya existe la relación
            $check_query = "SELECT * FROM productos_preparacion WHERE id_producto = $product_id AND id_preparacion = $preparation_id";
            $check_result = mysqli_query($conexion, $check_query);

            if (mysqli_num_rows($check_result) === 0) {
                // Insertar relación en la tabla productos_preparacion
                $insert_query = "INSERT INTO productos_preparacion (id_producto, id_preparacion) VALUES ($product_id, $preparation_id)";
                if (!mysqli_query($conexion, $insert_query)) {
                    // Registrar errores en caso de que falle la inserción
                    $errors[] = "Error al insertar la preparación ID $preparation_id: " . mysqli_error($conexion);
                }
            }
        }

        // Verificar si hubo errores
        if (empty($errors)) {
            $_SESSION['message'] = "Preparaciones añadidas con éxito al producto.";
            header('Location: ../admin.php');
        } else {
            $_SESSION['message'] = "Ocurrieron errores al agregar algunas preparaciones: <br>" . implode('<br>', $errors);
            header('Location: ../admin.php');
        }
    } else {
        $_SESSION['message'] = "No seleccionaste ninguna preparación.";
        header('Location: ../admin.php');
    }
} else {
    $_SESSION['message'] = "Por favor selecciona un producto y al menos una preparación.";
    header('Location: ../admin.php');
}
?>