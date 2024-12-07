<?php




include 'conexion_be.php';
include 'functions.php';

session_start(); // Inicia o reanuda la sesión para acceder a las variables de sesión

// Establece la conexión a la base de datos en UTF-8
mysqli_set_charset($conexion, "utf8");

// Obtiene las variables de sesión necesarias para añadir el producto al carrito
$user_id = $_SESSION['user_id'];
$fecha_recogida = $_POST['fecha_recogida'];
$hora_recogida = $_POST['hora_recogida'];
$precio = $_POST['total_price'];
$email = $_SESSION['email'];

// Consulta para obtener la información del cliente
$sql_cliente = "SELECT first_name, last_name, email, phone FROM users WHERE id = $user_id";
$result_cliente = query($sql_cliente);
$cliente = mysqli_fetch_assoc($result_cliente); // Obtiene la información como un array asociativo

// Inserta la orden en la tabla 'ordenes'
$sql = "INSERT INTO ordenes (usuario_id, fecha_compra, precio_total, hora_recogida) 
        VALUES ('$user_id','$fecha_recogida','$precio', '$hora_recogida')";
$data = query($sql);


// Recupera el ID de la orden recién creada
$orden_id = mysqli_insert_id($conexion);

$sql_email= "SELECT email FROM users WHERE id = $user_id";
$result_email = query($sql_email);
$resultado_email =mysqli_fetch_assoc($result_email);
$email_final = $resultado_email['email'];
if ($data && $orden_id) {
    // Selecciona todos los productos del carrito para el usuario
    $sql_carrito = "SELECT * FROM carrito WHERE id_usuario = $user_id";
    $result_carrito = query($sql_carrito);

    $productos_finalizados = [];
    if (mysqli_num_rows($result_carrito) > 0) {
        while ($row = mysqli_fetch_assoc($result_carrito)) {
            // Inserta cada producto en la tabla 'carritos_finalizados'
            $id_producto = $row['id_producto'];
            $cantidad = $row['cantidad'];
            $preparacion = $row['preparacion'];

            $sql_finalizado = "INSERT INTO carritos_finalizados (id_usuario, id_producto, cantidad, preparacion, id_orden) 
                               VALUES ('$user_id', '$id_producto', '$cantidad', '$preparacion', '$orden_id')";
            query($sql_finalizado);

            // Obtiene el detalle del producto para incluirlo en el correo
            $sql_producto = "SELECT nombre, descripcion FROM productos WHERE id = $id_producto";
            $result_producto = query($sql_producto);
            $producto = mysqli_fetch_assoc($result_producto);
            $producto['cantidad'] = $cantidad; // Añade la cantidad al detalle del producto
            $producto['preparacion'] = $preparacion; // Añade la preparación al detalle del producto
            $productos_finalizados[] = $producto;
        }
    }

    // Borra los productos del carrito
    $sql2 = "DELETE FROM carrito WHERE id_usuario = $user_id";
    $delete_cart = query($sql2);

    // Construye el cuerpo del correo con HTML
    $message = '<p><strong>Este es el resumen del pedido:</strong></p>';

    // Información del cliente
    $message .= '<p><strong>Informacion del cliente:</strong></p>';
    $message .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width: 100%;">';
    $message .= '<tr><th>Nombre</th><th>Email</th><th>Telefono</th></tr>';
    $message .= '<tr>';
    $message .= '<td>' . $cliente['first_name'] . ' ' . $cliente['last_name'] . '</td>';
    $message .= '<td>' . $cliente['email'] . '</td>';
    $message .= '<td>' . $cliente['phone'] . '</td>';
    $message .= '</tr>';
    $message .= '</table>';

    // Información del pedido
    $message .= '<p><strong>Detalles del pedido:</strong></p>';
    $message .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width: 100%;">';
    $message .= '<tr><th>Fecha de recogida</th><th>Hora de recogida</th><th>Precio total</th></tr>';
    $message .= '<tr><td>' . $fecha_recogida . '</td><td>' . $hora_recogida . '</td><td>' . $precio . ' euros</td></tr>';
    $message .= '</table>';

    // Detalles de los productos
    $message .= '<p><strong>Detalles de los productos:</strong></p>';
    $message .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width: 100%;">';
    $message .= '<tr><th>Nombre</th><th>Descripcion</th><th>Cantidad</th><th>Preparacion</th></tr>';

    foreach ($productos_finalizados as $producto) {
        $message .= '<tr>';
        $message .= '<td>' . $producto['nombre'] . '</td>';
        $message .= '<td>' . $producto['descripcion'] . '</td>';
        $message .= '<td>' . $producto['cantidad'] . ' kg</td>';
        $message .= '<td>' . $producto['preparacion'] . '</td>';
        $message .= '</tr>';
    }
    $message .= '</table>';

    // Envía el correo al usuario
    $subject = "Pedido:";
    $headers = "From: info@pescaderia.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    send_email($subject, $message, $email_final);

    // Establece el mensaje de éxito y redirige
    $_SESSION['message'] = "Su pedido se ha enviado correctamente";
    header('Location: ../index.php');
} else {
    $_SESSION['message'] = "Su pedido no pudo completarse, intentelo de nuevo.";
    header('Location: ../index.php');
}

exit();



