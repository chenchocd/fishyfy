<?php

//include 'functions.php';
header('Content-Type: application/json');
$conexion = mysqli_connect("localhost", "sergio", "IOuLmJ0Z5zBf/eG_","pescaderia");

if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $fake_price = [
        "22" => 100
    ];
    
$sql1 = "SELECT * FROM productos WHERE productos.id = '$product_id'";

$result = mysqli_query($conexion, $sql1);
$product = mysqli_fetch_assoc($result);

//echo json_encode(['price' => $fake_price["22"]]);
if($product_id){
    //echo json_encode(['price' => $product['precio_kg']]);
    echo json_encode(['price' => $product['precio_kg']]);
}else{
    echo json_encode(['error'=>'id del producto invalido']);
}
//exit();

}