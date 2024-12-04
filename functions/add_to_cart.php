<?php
include 'conexion_be.php';
include 'functions.php';

session_start(); //Inicia o reanuda la sesión para acceder a las variables de sesión

//Obtiene las variables de sesión necesarias para añadir el producto al carrito
$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$preparation = $_POST['preparation_name']?? "";


//Consulta SQL para añadir el producto al carrito
$sql = "INSERT INTO carrito (id_usuario, id_producto, cantidad, preparacion) VALUES ('$user_id','$product_id','$quantity', '$preparation')";
$data = query($sql);

//Establece un mensaje de éxito.
$_SESSION['message'] = "Se ha añadido correctamente";

if($_POST['form_selector'] && $_POST['form_selector']=="cart_form"){
    //Si modificas la cantidad desde la página del carrito lo vuelve a redirigir a la misma para efectuar los cambios
    header('Location: ../cart.php');
}else{
    //Redirige al usuario a la página de inicio después de añadir el producto al carrito
    header('Location: ../index.php');
}

//Finaliza el script para asegurar que la redirección funcione
exit();
