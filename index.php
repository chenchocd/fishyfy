<?php
include ('includes/header.php');

if(!logged_in()){
    redirect("login.php");
}
?>



    <!-- Contenido Principal -->
    <main>
        
        <section class="main_products">
            
            <?php
                display_message();
                //Realiza una consulta para obtener todos los produtos de la tabla producto
                if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['category_name'])){
                    $category_id = $_GET['category_name'];
                }
                
                
                $sql = "SELECT productos.nombre, productos.id, productos.precio_kg, productos.imagen, categorias.nombre AS category_name FROM productos JOIN categorias ON productos.id_categoria = categorias.id";
                if(isset($category_id)){
                    $sql .= " WHERE categorias.id = '$category_id'";
                }
                $result = mysqli_query($conexion, $sql);
                $sql2 = "SELECT * FROM categorias";
                $category_result = mysqli_query($conexion, $sql2);
            ?>
<div class="filters_container" data-aos="zoom-in" data-aos-duration="500">
        <div class="search_bar_container">
            <form action="search.php" method="GET">
            <label for="category">Buscar Producto:</label>
                <div class="search-container">
                <input type="text" name="search" placeholder="Search..." class="search-input">
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i>      
                </button>
                </div>
            </form>
        </div>
        <div class="category_selector_container">
            <form action="" method="GET">
                <label for="category">Filtrar por categoría:</label>
                <select name="category_name" id="category_name" onchange="this.form.submit()">
                    <option value="">Todas las categorías</option>
                    <?php
            
             while ($category = mysqli_fetch_assoc($category_result)):?>
                <option value="<?= $category['id'] ?>">
                    <?= $category['nombre'] ?>
                </option>

            <?php endwhile?>
                </select>
            </form>
        </div>
</div>
        <h1>Lista de Productos</h1>
        <div class="products_wrapper">
            <?php
            //Bucle while para recorrer cada fila de resultados obtenidos en la consulta SQL
            //Cada iteración representa un producto que se muestra en la página
             while ($row = mysqli_fetch_assoc($result)):?>
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
        </section>
    </main>

<?php
include ('includes/footer.php');
?>
