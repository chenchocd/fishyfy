<?php

//include 'functions.php';
//Encabezado para indicar que la respuesta será JSON
header('Content-Type: application/json');
$conexion = mysqli_connect("localhost", "sergio", "IOuLmJ0Z5zBf/eG_","pescaderia");

//Verifica si ha recibido el parámetro product_id mediante la URL
if(isset($_GET['product_id'])){
    //Obtiene el id y lo almacena en una variable
    $product_id = $_GET['product_id'];
    $fake_price = [
        "22" => 100
    ];
    
    //Consulta para buscar el producto con el id especificado
$sql1 = "SELECT * FROM productos WHERE productos.id = '$product_id'";

$result = mysqli_query($conexion, $sql1);
$product = mysqli_fetch_assoc($result);

//Si encuentra el producto
if($product_id){
    //Devuelve el precio en formato JSON
    echo json_encode(['price' => $product['precio_kg']]);
}else{
    echo json_encode(['error'=>'id del producto invalido']);
}
//exit();

}