

<header>
        <nav>
            <ul>
            <!--Verifica si el usuario no ha iniciado sesión -->
            <li><img src="assets/images/logo.png" alt="main_principal" class="logo_principal"></li>
            <?php if (!logged_in()): ?>

                <li><a href="login.php">Login</a></li>
            <?php endif ?>
                <!-- Verifica si el usuario ha iniciado sesión-->
                <?php 
                    if (logged_in()): ?>
                        
                        <li><a href="index.php">Tienda</a></li>
                        <li><a href="contacto.php">Contacto</a></li>
                        <li><a href="cart.php">Cesta</a></li>
                        <li><a href="logout.php">Cerrar Sesión</a></li>
                        <?php
                        if($_SESSION['rol'] == 'admin'):?>
                            <li><a href="admin.php">Admin</a></li>
                        
                        <?php endif ?>
                        
                        
                        
                        
                <?php endif ?>
                
                
                
            </ul>
        </nav>
    </header>

