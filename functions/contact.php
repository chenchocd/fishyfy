<?php

// Incluye los archivos necesarios
include 'conexion_be.php';
include 'functions.php';


session_start(); // Inicia o reanuda la sesión

// Verifica si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Obtén los datos del formulario
    $from = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $mensaje = trim($_POST['message']);

    // Construye el cuerpo del mensaje en HTML
    $message = "
        <h2>Nuevo mensaje de contacto</h2>
        <p><strong>Nombre:</strong> {$from}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Asunto:</strong> {$subject}</p>
        <p><strong>Mensaje:</strong><br>{$mensaje}</p>
    ";

    try {
        // Llama a la función para enviar el correo
        send_email($subject, $message, 'desarrollotest843@gmail.com'); 

        // Si el correo se envió correctamente, redirige con éxito
        $_SESSION['message'] = 'Tu mensaje ha sido enviado correctamente.';
        header('Location: ../index.php');
    } catch (Exception $e) {
        // Si hubo un error, muestra un mensaje
        $_SESSION['error'] = 'No se pudo enviar el mensaje. Por favor, inténtalo de nuevo.';
        header('Location: ../index.php');
    }
    exit();
} else {
    // Si el acceso no es válido, redirige al formulario de contacto
    $_SESSION['error'] = 'Acceso no autorizado.';
    header('Location: ../contact.php');
    exit();
}