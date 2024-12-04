<?php
include ('includes/header.php');

if(!logged_in()){
    redirect("login.php");
}


$total_price = $_GET['total'];
/*
$sql = "SELECT * FROM productos WHERE id = '$product_id'";
$result = mysqli_query($conexion, $sql);
$product = mysqli_fetch_assoc($result);
*/
?>

<div class="order_page">
    <?php
        display_message();
     ?>
    <form action="functions/finish_order.php" method="POST">
    <label for="total_price">Precio: </label>
    <input type="text" name="total_price" value="<?= $total_price ?>" readonly>
    <label for="fecha_recogida">Fecha de Recogida: </label>
    <?php
        $date_min = date("Y-m-d");
        $date_max = date("Y-m-d", strtotime("+1 day"));
    ?>
    <input type="date" name="fecha_recogida" min="<?= $date_min ?>" max="<?= $date_max ?>" required>
    <label for="hora_recogida">Hora de recogida</label>
    <input type="time" id="hora_recogida" name="hora_recogida" min="10:00" max="21:00" required>
    
    <button type="submit">Completar recogida</button>
    </form>
</div>