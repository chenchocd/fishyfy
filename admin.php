<?php
include ('includes/header.php');

    //Si intentasen acceder directamente a la página de administración sin las credenciales necesarias,
    //lo redirige automáticamente al index

    if($_SESSION['rol'] == 'customer'){
        header("location: index.php");
    }
?>


<div class="alert_message">
<?php
display_message();
?>
</div>

<?php
$sql = "SELECT * FROM productos";
$product_result = mysqli_query($conexion, $sql);
$sql2 = "SELECT * FROM categorias";
$category_result = mysqli_query($conexion, $sql2);
$sql3= "SELECT * FROM preparacion";
$preparation_result = mysqli_query($conexion, $sql3);
?>

<div class="admin_container">
        <!-- Barra lateral de navegación -->
        <aside class="sidebar">
            <h2>Administrador</h2>
            <nav>
                <ul class="sidebar_product">
                    <li><a href="#add_product">Agregar Producto</a></li>
                    <li><a href="#add_preparation">Agregar Preparación</a></li>
                    <li><a href="#edit_product">Modificar Producto</a></li>
                    <li><a href="#delete_product">Eliminar Producto</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <main class="content">
            <!-- Sección de agregar producto -->
            <section id="add_product">
                <h2>Agregar Producto</h2>
                <form action="functions/add_product.php" method="POST" enctype="multipart/form-data">
                    <label for="product_name">Nombre del Producto:</label>
                    <input type="text" id="product_name" name="product_name" required>

                    <label for="product_description">Descripción:</label>
                    <textarea id="product_description" name="product_description" rows="4" required></textarea>

                    <label for="product_price">Precio:</label>
                    <input type="float" id="product_price" name="product_price" required>

                    <label for="product_stock">Stock:</label>
                    <input type="number" id="product_stock" name="product_stock" required>

                    <label for="product_image">Imagen:</label>
                    <input type="file" id="product_image" name="product_image" required>

                    <label for="category">Filtrar por categoría:</label>
                    <select name="category_name" id="category_name">
                    <option value="">Todas las categorías</option>
                    <?php
            
                        while ($category = mysqli_fetch_assoc($category_result)):?>
                            <option value="<?= $category['id'] ?>">
                                <?= $category['nombre'] ?>
                            </option>

            <?php endwhile?>
                </select>
                    
                    

                    <button type="submit">Agregar Producto</button>
                </form>
            </section>



            <?php
                $product_result = mysqli_query($conexion, $sql);
            ?>

           <!-- Sección de agregar preparación -->
<section id="add_preparation">
    <h2>Agregar Preparación</h2>
    <form action="functions/add_preparation.php" method="POST">
        <!-- Seleccionar Producto -->
        <label for="product">Selecciona un producto:</label>
        <select name="product" id="product" required>
            <option value="">Seleccione un producto</option>
            <?php while ($product = mysqli_fetch_assoc($product_result)): ?>
                <option value="<?= $product['id'] ?>">
                    <?= $product['nombre'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <!-- Mostrar Preparaciones como Checkboxes -->
        <label>Selecciona las preparaciones:</label>
        <div id="preparation-options">
            <?php while ($preparation = mysqli_fetch_assoc($preparation_result)): ?>
                <div>
                    <input type="checkbox" id="preparation_<?= $preparation['id'] ?>" name="preparations[]" value="<?= $preparation['id'] ?>">
                    <label for="preparation_<?= $preparation['id'] ?>">
                        <?= $preparation['nombre'] ?>
                    </label>
                </div>
            <?php endwhile; ?>
        </div>

        <button type="submit">Agregar Preparación</button>
    </form>
</section>


            <?php
                $product_result = mysqli_query($conexion, $sql);
            ?>

            <!-- Sección de modificar producto -->
            <section id="edit_product">
                <h2>Modificar Producto</h2>
                <form action="functions/modify_product.php" method="POST">
                <label for="product">Selecciona un producto:</label>
                    <select name="select_product89" id="select_product89">
                    <option value="">Seleccione un producto</option>
                    <?php
            
                        while ($product = mysqli_fetch_assoc($product_result)):?>
                            <option value="<?= $product['id'] ?>">
                                <?= $product['nombre'] ?>
                            </option>

            <?php endwhile?>
                </select>

                    <label for="new_product_price">Nuevo Precio:</label>
                    <input type="float" id="new_product_price" name="new_product_price">

                    <button type="submit">Modificar Producto</button>
                </form>
            </section>

            <?php
                $product_result = mysqli_query($conexion, $sql);
            ?>

            <!-- Sección de eliminar producto -->
            <section id="delete_product">
                <h2>Eliminar Producto</h2>
                <form action="functions/delete_product.php" method="POST"onsubmit="return confirmDeletion();">
                <label for="product">Selecciona un producto:</label>
                    <select name="product" id="product">
                    <option value="">Seleccione un producto</option>
                    <?php
            
                        while ($product = mysqli_fetch_assoc($product_result)):?>
                            <option value="<?= $product['id'] ?>">
                                <?= $product['nombre'] ?>
                            </option>

            <?php endwhile?>
                </select>
                    <button type="submit">Eliminar Producto</button>
                </form>
            </section>

            <script>
                function confirmDeletion() {
                    // Mostrar un mensaje de confirmación
                    return confirm("¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.");
                }
            </script>

            <!-- Sección de lista de productos -->
            
        </main>
    </div>
















<?php
include ('includes/footer.php');
?>