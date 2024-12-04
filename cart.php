<?php
include ('includes/header.php');

if(!logged_in()){
    redirect("login.php");
}
?>

<?php
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT carrito.id, productos.nombre, productos.precio_kg, productos.id, productos.stock, carrito.preparacion, SUM(carrito.cantidad) AS cantidad_carrito FROM carrito JOIN productos ON carrito.id_producto = productos.id WHERE carrito.id_usuario = $user_id GROUP BY carrito.id_producto";
    $result = mysqli_query($conexion, $sql);

    $sql2 = "SELECT SUM(carrito.cantidad) AS cantidad_total FROM carrito WHERE carrito.id_usuario = $user_id";
    $total_result = mysqli_query($conexion, $sql2);
    $cantidad_array = mysqli_fetch_assoc($total_result);
    $cantidad_total = $cantidad_array['cantidad_total'];

    $sql3= "SELECT SUM(productos.precio_kg * carrito.cantidad) AS precio_total FROM carrito JOIN productos ON carrito.id_producto = productos.id WHERE carrito.id_usuario = $user_id";
    $total_price = mysqli_query($conexion, $sql3);
    $precio_array = mysqli_fetch_assoc($total_price);
    $precio_total = round($precio_array['precio_total'],2);

    $sql4= $sql = "SELECT productos.nombre, productos.id, productos.precio_kg, productos.imagen, categorias.nombre AS category_name FROM productos JOIN categorias ON productos.id_categoria = categorias.id";
    $result2 = mysqli_query($conexion, $sql);

    
?>

<div class="alert_message cart_page">
<?php
display_message();
?>
</div>

<?php
delete_cart_item();

?>


<div class="carts_wrapper">
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Preparación</th>
                <th>Modificar Producto</th>
                <th>Eliminar</th>
            </tr>
            <?php
             while ($row = mysqli_fetch_assoc($result)):?>
                <tr class="cart">
                    <td><p><?= $row['id'] ?></p></td>
                    <td><h3><?= $row['nombre'] ?></h3></td>
                    <td><p><?= $row['cantidad_carrito'] ?> kg/aprox</p></td>
                    <td><p><?= $row['precio_kg'] ?> €/kg</p></td>
                    <td><p><?= $row['preparacion'] ?></p></td>
                    <td>
                        <form action="functions/add_to_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="form_selector" value="cart_form">
                            <input type="number" name="quantity" value="0.5" min="0.5" max="<?= $row['stock'] ?>">
                            <button type="submit" class="add_button"><svg enable-background="new 0 0 512 512" height="512px" id="Layer_1" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M256,512C114.625,512,0,397.391,0,256C0,114.609,114.625,0,256,0c141.391,0,256,114.609,256,256  C512,397.391,397.391,512,256,512z M256,64C149.969,64,64,149.969,64,256s85.969,192,192,192c106.047,0,192-85.969,192-192  S362.047,64,256,64z M288,384h-64v-96h-96v-64h96v-96h64v96h96v64h-96V384z"/></svg>
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                            <button class="delete_button"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
                                <path d="M 21 2 C 19.354545 2 18 3.3545455 18 5 L 18 7 L 10.154297 7 A 1.0001 1.0001 0 0 0 9.984375 6.9863281 A 1.0001 1.0001 0 0 0 9.8398438 7 L 8 7 A 1.0001 1.0001 0 1 0 8 9 L 9 9 L 9 45 C 9 46.645455 10.354545 48 12 48 L 38 48 C 39.645455 48 41 46.645455 41 45 L 41 9 L 42 9 A 1.0001 1.0001 0 1 0 42 7 L 40.167969 7 A 1.0001 1.0001 0 0 0 39.841797 7 L 32 7 L 32 5 C 32 3.3545455 30.645455 2 29 2 L 21 2 z M 21 4 L 29 4 C 29.554545 4 30 4.4454545 30 5 L 30 7 L 20 7 L 20 5 C 20 4.4454545 20.445455 4 21 4 z M 11 9 L 18.832031 9 A 1.0001 1.0001 0 0 0 19.158203 9 L 30.832031 9 A 1.0001 1.0001 0 0 0 31.158203 9 L 39 9 L 39 45 C 39 45.554545 38.554545 46 38 46 L 12 46 C 11.445455 46 11 45.554545 11 45 L 11 9 z M 18.984375 13.986328 A 1.0001 1.0001 0 0 0 18 15 L 18 40 A 1.0001 1.0001 0 1 0 20 40 L 20 15 A 1.0001 1.0001 0 0 0 18.984375 13.986328 z M 24.984375 13.986328 A 1.0001 1.0001 0 0 0 24 15 L 24 40 A 1.0001 1.0001 0 1 0 26 40 L 26 15 A 1.0001 1.0001 0 0 0 24.984375 13.986328 z M 30.984375 13.986328 A 1.0001 1.0001 0 0 0 30 15 L 30 40 A 1.0001 1.0001 0 1 0 32 40 L 32 15 A 1.0001 1.0001 0 0 0 30.984375 13.986328 z"></path>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endwhile?>
        </table>
        <div class="total_price_wrapper">
            <p><strong>Cantidad total: </strong><span><?= $cantidad_total?> Kg</span></p>
            <p><strong>Precio total: </strong><span><?= $precio_total?> €</span></p>
        </div>
        
        <button class="finalizar_compra">
            <a href="order.php?total=<?= $precio_total ?>">Finalizar Compra</a>
        </button>
        
</div>
<div class="product_carrusel_wrapper">
<div class="product_carrusel">
            <?php
            //Bucle while para recorrer cada fila de resultados obtenidos en la consulta SQL
            //Cada iteración representa un producto que se muestra en la página
             while ($row = mysqli_fetch_assoc($result2)):?>
                <div class="product">
                    <div class="product_tag">
                        <p><?= $row['category_name'] ?></p>
                    </div>
                    <h3><?= $row['nombre'] ?></h3>
                    <img src="assets/images/<?= $row['imagen'] ?>" alt="">
                    <p>Precio: <?= $row['precio_kg'] ?> €/kg</p>
                    <button class="product_grip_button">
                        <!-- El enlace pasa el id del producto en la URL como parámetro para identificar el producto-->
                        <a href="producto.php?id=<?= $row['id'] ?>">Ver Producto</a>
                    </button>
                </div>

            <?php endwhile?><!--Fin del bucle while -->
            </div>
</div>


<?php
include ('includes/footer.php');
?>
