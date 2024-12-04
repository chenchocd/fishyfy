<?php
session_start();        //Inicia o reanuda la sesión
session_destroy();      //Destruye todas las variables de sesión y cierra la sesión
header("location: ../index.php");       //Redirige al usuario a la página de inicio

?>