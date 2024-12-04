<?php
include('includes/header.php');

if (!logged_in()) {
    redirect("login.php");
}

$product_id = $_GET['id'];

$sql1 = "SELECT * FROM productos WHERE productos.id = '$product_id'";



$sql2 = "SELECT productos.nombre, productos.descripcion, productos.imagen, productos.precio_kg, productos.id, productos.stock, GROUP_CONCAT(preparacion.nombre) AS preparaciones FROM productos JOIN productos_preparacion ON productos.id = productos_preparacion.id_producto JOIN preparacion ON preparacion.id = productos_preparacion.id_preparacion WHERE productos.id = '$product_id' GROUP BY productos.id, productos.nombre, productos.descripcion, productos.precio_kg, productos.stock";

$result = mysqli_query($conexion, $sql1);
$product = mysqli_fetch_assoc($result);
$result_preparation = mysqli_query($conexion, $sql2);
$preparation_list = mysqli_fetch_assoc($result_preparation);
$fix_preparation_list = explode(',',$preparation_list['preparaciones']);

?>

<div class="single_product">
    <?php
    display_message();
    ?>
    <div class="content_wrapper" id="product_content_1">
        <div class="content_innerwrapper">
            <div class="content_left_wrapper">
                <div class="tittle_wrapper">
                    <h1><?= $product['nombre'] ?></h1>

                </div>



                <div class="image_wrapper">
                    <img src="assets/images/<?= $product['imagen'] ?>" alt="<?= $product['nombre'] ?>">
                </div>
            </div>

            <div class="text_wrapper">
                <p><?= $product['descripcion'] ?></p>
                <p>
                    <p>
                        <strong>Preparación: </strong></p>
                        <div class="preparation_list">
                            <label for="category">Seleccionar Preparación:</label>
                                <select name="preparation_name" id="preparation_name" onchange="this.form.submit()">
                                    <option value="">Todas las preparaciones</option>
                                 <?php
            
                                    foreach ($fix_preparation_list as $preparation){
                                        ?>
                                <option value="<?= $preparation ?>">
                                    <?= $preparation ?>
                                </option>

                            <?php }?>
                            </select>
                        </div>
                </div>
                <p><strong>Precio €/kg: </strong><?= $product['precio_kg'] ?> </p>
                <form action="functions/add_to_cart.php" method="POST" class="form_add_to_cart">
                    <input type="hidden" name="preparation_name"  id="preparation_name_hidden" value="">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <p>Cantidad en kg:</p>
                    <input type="number" name="quantity" value="0.5" min="0.5" max="<?= $product['stock'] ?>" step="0.5">
                    <button type="submit">Añadir al carrito</button>
                </form>
            </div>
        </div>

    </div>
</div>













<?php
include('includes/footer.php');
?>