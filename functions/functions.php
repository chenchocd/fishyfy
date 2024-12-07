<?php
//Funciones helpers

// Importar las clases de PHPMailer
// Deben estar al principio, no dentro de una función
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;





require $_SERVER['DOCUMENT_ROOT'] . '/pescaderia/vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

/*
Esta función es útil para validar la disponibilidad de un nombre de usuario antes de permitir su registro,
asegurando así la unicidad de los nombres de usuario en la bbdd
*/
function username_exist($user_name){
    $sql = "SELECT id FROM users WHERE user_name = '$user_name'";
    $result = query($sql);
    if(row_count($result)==1){
        return true;
    }else{
        return false;
    }
}

//Igual que la anterior, verifica si ya hay un email registrado y evita su duplicidad
function email_exist($email){
    $sql = "SELECT id FROM users WHERE email = '$email'";
    $result = query($sql);
    if(row_count($result)==1){
        return true;
    }else{
        return false;
    }
}

function register_user($first_name, $last_name, $user_name, $email, $phone, $password){
    //Sanitiza los datos de entrada usando la función escape para prevenir inyecciones SQL
    $first_name = escape($first_name);
    $last_name = escape($last_name);
    $user_name = escape($user_name);
    $email = escape($email);
    $phone = escape($phone);
    $password = escape($password);
    //Cifra la contraseña usando md5 antes de almacenarla en la bbdd
    $password = md5($password);

    //Verifica si el email ya existe en la bbdd
    if(email_exist($email)){
        return false; //Si existe, retorna falso y no registra al usuario
        //Lo mismo pero con el usuario
    }else if(username_exist($user_name)){
        return false;
    }else{
        //Genera un código de validación único usando md5 y microtime para añadir aletoriedad
        $validation_code = md5($user_name . microtime());
        //Define la consulta SQL para insertar el nuevo usuario en la bbdd
        $sql = "INSERT INTO users (first_name, last_name, user_name, email, phone, password, validation_code, active)";
        $sql .= " VALUES ('$first_name', '$last_name', '$user_name', '$email', '$phone', '$password', '$validation_code', 0)";
        $data = query($sql);
        confirm($data);

        
        $subject = "Activar cuenta.";
        /*$message = 'Haga click en este link para activar su cuenta
        localhost/pescaderia/activate.php?email='. $email . '&code='. $validation_code .'';
        */
        $message = '<p><strong>Haga click en este link para activar su cuenta</strong> 
        <a href="localhost/pescaderia/activate.php?email=' . $email . '&code=' . $validation_code . '">Activar cuenta</a></p>';
        $from = 'From: info@pescaderia.com';
        send_email($subject, $message, $email);
        return true;

    }

    
}

/*
La función send_email es una implementación que utiliza la biblioteca PHPMailer 
para enviar un correo electrónico a través del servidor SMTP de Gmail.
*/
function send_email($subject, $message, $user){
    //Configuración de SMTP de Gmail
    $email = 'desarrollotest843@gmail.com'; // Dirección de gmail
    $appPassword = getenv('PASS_EMAIL'); //Contraseña de la App de Gmail, está cifrada en el archivo .env
    

    //Crea una nueva instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        //Configuraciones del servidor, tal y como lo documenta en la librería
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $email;
        $mail->Password = $appPassword;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Encabezado del correo
        $mail->setFrom($email, 'Your Name'); //Remitente (mi Gmail)
        $mail->addAddress($user); //Destinatario, (correo del usuario)
        $mail->addCC($email); //Añadir copia a mi correo
        $mail->Subject = $subject; //Asunto del correo

        // Email content
        $mail->isHTML(true); //Dar formato HTML al correo
        $mail->Body = $message; //Contenido principal del mensaje
        $mail->AltBody = strip_tags($message); //Texto plano

        //Enviar email
        $mail->send();
        echo 'Mail sent successfully to yourself.';
    } catch (Exception $e) {
        echo 'Mail could not be sent. Error: ', $mail->ErrorInfo;
    }
}

/*
Centraliza el formato de los mensajes de error.
Cualquier mensaje de error pasado a esta función se convierte en un párrafo HTML,
lo que facilita una presentación clara en la interfaz.
*/
function validation_errors($error){
    $error_message = '<p>'.$error.'</p>';
    return $error_message;
}


//Sanitiza una cadena de texto al convertir caracteres especiales en sus equivalentes en HTML
function clean($string){
    return htmlentities($string);
}

//función para redireccionar
function redirect($location){
    return header("location: {$location}");
}

//Mostrar mensajes de usuario como confirmaciones o errores
function set_message($message){
    //Verifica si el mensaje no está vacio
    if(!empty($message)){
        //Si el mensaje no está vacio, lo almacena en la sesión
        $_SESSION['message'] = $message;
    }else{
        //Si el mensaje está vacío, establece $mensaje a una cadena vacía
        $message = "";
    }
}

//Mostrar un mensaje almacenado en la variable de sesión y luego eliminarlo de la sesión para que no lo muestre nuevamente.
function display_message(){
    
    if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

//Función para validar el registro de usuario
function validate_user_registration(){
    $errors = [];   //Inicializa un array para almacenar los mensajes de error
    $min = 4;       //Define el tamaño mínimo de caracteres permitido
    $max = 30;      //Define el tamaño máximo de caracteres permitido

    //Verifica si el formulario fué enviado mediante POST y si el formuario es el de registro
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['form_selector']=="register_form"){
        $first_name = clean($_POST['first_name']);
        $last_name = clean($_POST['last_name']);
        $user_name = clean($_POST['user_name']);
        $email = clean($_POST['email']);
        $phone = clean($_POST['phone']);
        $password = clean($_POST['password']);
        $confirm_password = clean($_POST['confirm_password']);
        

        //Verificación de existencia de usuario y correo electrónico en la bbdd
        if(username_exist($user_name)){
            $errors[] = "El usuario ya existe";
        }
            
        
        if(email_exist($email)){
            $errors[] = "El email ya existe";
        }
        
       
        //Verifica que la contraseña y su confirmación coincidan
        if($password !== $confirm_password){
           $errors[] = "Usuario o contraseña incorrecta";
        }
        
        //Si hay errores, los muestra
        if(!empty($errors)){
            foreach ($errors as $error){
                echo '<div class="contenedor_errores">';
                echo validation_errors($error); //Función que hemos creado para que nos muestre el error en HTML
                echo '</div>';
            }
        }else{
            //Si no hay errores, registra al usuario y muestra un mensaje
            if(register_user($first_name,$last_name,$user_name,$email,$phone,$password)){
                set_message('<p>Por favor revisa tu email, recibirás un código de activación.</p>');
                redirect("login.php");
            }else{
                set_message('<p>No pudo registrarse correctamente</p>');
                redirect("login.php");
            }
        }
            

    }




}

//Función para activar usuario con código de verificación
function activate_user(){
    //Verifica si el formulario se envió mediante una solicitud GET
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        //Verifica si el parámetro email está presente en la URL
        if(isset($_GET['email'])){
            $email = clean($_GET['email']);
            $validation_code = clean($_GET['code']);

            //Consulta para verificar si existe un usuario con el email y código de validación
            $sql = "SELECT id FROM users WHERE email = '".escape($_GET['email'])."' AND validation_code = '".escape($_GET['code']). "'";
            $result = query($sql);
        

            /*print_r($sql);
            print_r($result);*/

            confirm($result);

            //Si el usuario existe, se procesa la activación de la cuenta
            if(row_count($result)==1){
                //Actualiza el estado de activación del usuario y elimina el código de validación
                $sql2 = "UPDATE users SET active = 1, validation_code = 0  WHERE email = '".escape($_GET['email'])."' AND validation_code = '".escape($_GET['code']). "'";
                $result2 = query($sql2);
                confirm($result2);

                //Muestra un mensaje de éxito y redirige al usuario a la página de inicio de sesión
                set_message('<p>Su cuenta ha sido activada satisfactoriamente</p>');
                redirect('login.php');
            }else{
                //Si el usuario no exite o los datos no coinciden, muestra un mensaje de error y redirige 
                set_message('<p>Su cuenta no fué activada satisfactoriamente</p>');
                redirect('login.php');
            }
            
        }
    }
}

//Función que valida los campos de inicio de sesión para asegurarse de que se ingresen correctamente
function validate_user_login(){
    $errors = [];       //Array para almacenar posibles errores.

    //Verifica si el formulario se ha enviado con el método POST y corresponde al formulario de login
    if($_SERVER['REQUEST_METHOD']=="POST" && $_POST['form_selector']=="login_form"){

        $email = clean($_POST['usuario']);
        $password = clean($_POST['password']);
    

        //Verifica si los campos están vacios
        if(empty($email)){
            $errors[] = "El email no puede estar vacio.";
        }

        if(empty($password)){
            $errors[] = "El password no puede estar vacio.";
        }
        //Si hay errores, los muestra en la pantalla
        if(!empty($errors)){
            foreach($errors as $error){
                echo validation_errors($error);
            }
        }else{
            //Si no hay errores, intenta iniciar sesión con la función login_user
            if(login_user($email,$password)){
                $rol = $_SESSION['rol'];
                if($rol == 'customer'){
                    //Si todo es correcto, entramos en la página
                    redirect("index.php");
                }else{
                    redirect("admin.php");
                }
                
                
            }else{
                //Si las credenciales no coinciden, muestra un mensaje de error
                echo validation_errors("tu usuario o contraseña no son correctos");
            }
        }
    }
}

//
function login_user($email, $password){
    //Consulta SQL para obtener la contraseña y el ID de usuario donde el usuario es el especificado y está activo
    $sql = "SELECT password, id, rol FROM users WHERE user_name='".escape($email)."' AND active = 1";
    $result = query($sql);
    //Verifica si se ha encontrado un registro que coincida
    if(row_count($result)==1){
        //Obtiene los datos del usuario (contraseña e ID)
        $data = fetch_array($result);
        $db_password = $data['password'];
        //Compara la contraseña ingresada, encriptada en md5, con la almacenada en la bbdd
        if(md5($password)== $db_password){
            //Si la contraseña es correcta, establece variables de sesión para el usuario
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['rol'] = $data['rol'];
           return true;
        }

    }else{
        return false;
    }
}




//Función que verifica si un usuario ha iniciado sesión
function logged_in(){
    //Verifica si la variable de sesión 'email' está establecida
    if(isset($_SESSION['email'])){
        return true; //Si está configurada, el usuario ha iniciado sesión
    }else{
        return false;  //Si no está configurada, el usuario no ha iniciado sesión
    }
}

//Funcion que borra los productos del carrito
function delete_cart_item(){
    if($_SERVER['REQUEST_METHOD']=="POST"){
        //Obtiene el ID del producto
        $product_id = clean($_POST['product_id']);
        //Consulta para eliminar el producto del carrito según su ID
        $sql = "DELETE  FROM carrito WHERE id_producto = $product_id";
        $result = query($sql);
        //Comprueba si la eliminación fué exitosa
        if($result == 1){
            $_SESSION['message'] = "Se ha eliminado correctamente.";
        }else{
            $_SESSION['message'] = "No se pudo eliminar el producto.";
        }
        
        header('Location: cart.php');
        exit();
    }
}
/*
Es una abreviatura de "Dump and Die" (volcar y detener) y su propósito es mostrar datos en un formato legible
y detener la ejecución del script para facilitar la depuración.
*/
function dd($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    exit();
}