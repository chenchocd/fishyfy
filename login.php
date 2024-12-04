<?php

    include ('includes/header.php');
    

    /*session_start();

    if(isset($_SESSION['usuario'])){
        header("location: catalogo.php");
    }*/

?>

<div class="alert_message">
<?php
validate_user_registration();
validate_user_login();
display_message();
?>
</div>


<main class="main_login_wrapper">
<div class="contenedor__todo">

<div class="caja__trasera">

    

    <div class="caja__trasera-login">
        <h3>¿Ya tienes una cuenta?</h3>
        <p>Inicia sesión para entrar en la página</p>
        <button id="btn__iniciar-sesion">Iniciar Sesión</button>
    </div>
    <div class="caja__trasera-register">
        <h3>¿Aún no tienes una cuenta?</h3>
        <p>Regístrate para que puedas iniciar sesión</p>
        <button id="btn__registrarse">Registrarse</button>
    </div>
</div>
<div class="contenedor__login-register">
    <!--Formulario de login y registro-->
    <form  method="POST" class="formulario__login">
        <!--Login-->
        <h2>Iniciar sesión</h2>
        <input type="hidden" name="form_selector" value="login_form">
        <input type="text" placeholder="usuario" name="usuario">
        <input type="password" placeholder="Contraseña" name="password">
        <button>Entrar</button>
    </form>
    <!--Registro-->
    <form action="" method="POST" class="formulario__register">
        <h2>Registrarse</h2>
        <input type="hidden" name="form_selector" value="register_form">
        <!-- Campo Nombre -->
        <input type="text" placeholder="Nombre" name="first_name" 
           minlength="4" maxlength="20" 
           required pattern="[a-zA-ZÀ-ÿ\s]+" 
           title="El nombre debe tener entre 4 y 20 caracteres y solo puede contener letras y espacios.">
        <!-- Campo Apellido -->
        <input type="text" placeholder="Apellido" name="last_name" 
           minlength="4" maxlength="20" 
           required pattern="[a-zA-ZÀ-ÿ\s]+" 
           title="El apellido debe tener entre 4 y 20 caracteres y solo puede contener letras y espacios.">
        <!-- Campo Usuario -->
        <input type="text" placeholder="Usuario" name="user_name" 
           minlength="4" maxlength="20" 
           required pattern="[a-zA-Z0-9_]+" 
           title="El nombre de usuario debe tener entre 4 y 20 caracteres y solo puede contener letras, números y guiones bajos.">
        <!-- Campo Correo Electrónico -->
        <input type="email" placeholder="Correo electrónico" name="email" 
           required title="Introduce un correo electrónico válido.">
        <!-- Campo Teléfono -->
        <input type="text" placeholder="Teléfono" name="phone" 
           required pattern="\d{9}" 
           title="El número de teléfono debe contener exactamente 9 dígitos.">
        <!-- Campo Contraseña -->
        <input type="password" placeholder="Contraseña" name="password" 
           minlength="8" maxlength="20" 
           required title="La contraseña debe tener entre 8 y 20 caracteres.">
        <!-- Campo Confirmar Contraseña -->
        <input type="password" placeholder="Confirmar contraseña" name="confirm_password" 
           minlength="8" maxlength="20" 
           required title="Las contraseñas deben coincidir.">
        <button>Registrarse</button>
    </form>
</div>
</div>
</main>

<?php
include ('includes/footer.php');
?>
    
        
