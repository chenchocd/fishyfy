<?php
include 'conexion_be.php';
include 'functions.php';

session_start(); //Inicia o reanuda la sesión para acceder a las variables de sesión

//Obtiene las variables de sesión necesarias para añadir el producto al carrito
$product_id = $_POST['select_product89'];
$new_price = $_POST['new_product_price'];


//Consulta SQL para añadir el producto al carrito
$sql = "UPDATE productos SET productos.precio_kg = $new_price WHERE productos.id = $product_id";
$data = query($sql);

//Establece un mensaje de éxito.
$_SESSION['message'] = "Se ha actualizado correctamente";
  
header('Location: ../admin.php');

//Finaliza el script para asegurar que la redirección funcione
exit();