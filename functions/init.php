<?php

ob_start();     //Inicia el almacenamiento en búfer de salida

session_start();    //Inicia una nueva sesión o reanuda la sesión existente

include ('conexion_be.php'); 
include ('functions.php');

/*
ob_start()
Esta función activa el almacenamiento en bufer de salida, lo que permite que las salidas HTML o los encabezados se envien 
en el momento deseado, incluso después de algún contenido que normalmente causaría error. Es útil para redirecciones,
control de flujo de salida y evitar errores de encabezado.

session_start
Inicia una sesión o reanuda la existente para almacenar y gestionar variables de sesión. Crucial para las aplicaciones
que requieren autentificación.

*/