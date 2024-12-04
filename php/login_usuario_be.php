<?php





$errors = []; //Inicializa un array para almacenar errores

    //Verifica si se ha enviado un formulario mediante POST
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);


        if(empty($email)){
            $errors[] = "El email no puede estar vacio.";
        }

        if(empty($password)){
            $errors[] = "El password no puede estar vacio.";
        }

        if(!empty($errors)){
            foreach($errors as $error){
                echo validation_errors($error);
            }
        }else{
            if(login_user($email,$password)){
                redirect("index.php");
            }
        }
    }