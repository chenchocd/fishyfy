<?php

include 'conexion_be.php';

include 'functions.php';

session_start();

// Captura los datos enviados por el formulario mediante el método POST
$product_name = $_POST['product_name']; // Nombre del producto
$product_description = $_POST['product_description']; // Descripción del producto
$product_price = $_POST['product_price']; // Precio por kilogramo del producto
$product_stock = $_POST['product_stock']; // Stock disponible del producto
$category_name = $_POST['category_name']; // Categoría a la que pertenece el producto

// Verifica si se subió un archivo a través del formulario
if($_FILES['product_image']){
    // Captura información sobre la imagen subida
    $file_name = $_FILES['product_image']['name']; // Nombre original del archivo
    $file_type = $_FILES['product_image']['type']; // Tipo del archivo
    $file_temp_name = $_FILES['product_image']['tmp_name']; // Ruta temporal donde se almacena el archivo en el servidor

    // Define un arreglo con los tipos de archivo permitidos (en este caso, solo imágenes en formato webp)
    $allow_files = ['image/webp'];

    // Verifica si el tipo del archivo está en la lista de permitidos
    if(in_array($file_type, $allow_files)){
        // Define el directorio donde se almacenarán las imágenes subidas
        $image_directory = '../assets/images/';

        // Crea un nuevo nombre único para el archivo para evitar conflictos de nombres
        $new_file_name = uniqid().$file_name;

        // Mueve el archivo de su ubicación temporal al directorio de destino
        if(move_uploaded_file($file_temp_name, $image_directory.$new_file_name)){
            // Si el archivo se subió correctamente, crea la consulta SQL para insertar los datos del producto en la base de datos
            $sql = "INSERT INTO productos (nombre, descripcion, precio_kg, stock, imagen, id_categoria) 
                    VALUES ('$product_name', '$product_description', '$product_price', '$product_stock', '$new_file_name', '$category_name')";

            $data = query($sql);

            
            if($data){
                // Si se inserta correctamente, guarda un mensaje de éxito en la sesión y redirige al panel de administrador
                $_SESSION['message'] = "El producto se ha añadido correctamente";
                header('Location: ../admin.php');
            }else{
                
                $_SESSION['message'] = "El producto no se ha añadido correctamente";
                header('Location: ../admin.php');
            }
        }else{
            // Si ocurre un error al mover el archivo, guarda un mensaje de error y redirige al panel de administrador
            $_SESSION['message'] = "La imagen no se subió satisfactoriamente";
            header('Location: ../admin.php');
        }
    }

   
    header('Location: ../admin.php');
    exit();
}
