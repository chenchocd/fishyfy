<?php
include ('includes/header.php');

if(!logged_in()){
    redirect("login.php");
}
?>


<?php
$search_param = $_GET['search'];
$sql = "SELECT * FROM productos WHERE nombre LIKE '$search_param%'";


$result = mysqli_query($conexion, $sql);
?>

<div class="main_products">
    <div class="products_wrapper">




<?php
            if(row_count($result)>0):
                while ($row = mysqli_fetch_assoc($result)):?>
                    <div class="product">
                        <h3><?= $row['nombre'] ?></h3>
                        <img src="assets/images/<?= $row['imagen'] ?>" alt="">
                        <p>Precio: <?= $row['precio_kg'] ?> €/kg</p>
                        <button>
                            <!-- El enlace pasa el id del producto en la URL como parámetro para identificar el producto-->
                            <a href="producto.php?id=<?= $row['id'] ?>">Ver Producto</a>
                        </button>
                    </div>
    
                <?php endwhile?>
            <?php else:?>
                <p>No se encontraron resultados en su búsqueda.</p>
            <?php endif?>
</div>
</div>
            

            
             














<?php
include ('includes/footer.php');
?>