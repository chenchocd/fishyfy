<?php
    session_start();

    if(!isset($_SESSION['usuario'])){
        echo '
        <script>
            alert("Debes iniciar sesión.");
            window.location = "index.php";
        </script>
    ';
    session_destroy(); //Por seguridad se cieerra cualquier sesión activa
    die();
    
    }

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>
</head>
<body>
    <h1>Bienvenido</h1>
    <a href="php/cerrar_sesion.php">Cerrar sesión</a>
</body>
</html>