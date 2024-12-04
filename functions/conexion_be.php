<?php

    $conexion = mysqli_connect("localhost", "sergio", "IOuLmJ0Z5zBf/eG_","pescaderia");

    /*
    if($conexion){
        echo "Conexión exitosa a la base de datos";
    }else{
        echo "No se ha podido conectar a la base de datos";
    }
        */

    //Usa la función mysqli_num_rows para contar el número de filas en el resultado y lo devuelve
    function row_count($results){
        return mysqli_num_rows($results);
    }

    //Verifica si una consulta se ha ejecutado correctamente y, en caso de error, detener la ejecución y mostrar un mensaje de error
    function confirm($result){
        global $conexion;
        if(!$result){
            die("La consulta falló" . mysqli_error($conexion));
        }
    }

    function query($query){
        //Accede a la variable global $conexion, que contiene la conexión a la bbdd
        global $conexion;
        //Ejecuta la consulta SQL usando mysqli_query y almacena el resultado en la variable $result
        $result = mysqli_query($conexion, $query);
        //Llama a la función confirm para verificar si la consulta fué exitosa
        confirm($result);
        //Devuelve el resultado de la consulta
        return $result;
    }

    /*
    La función fetch_array simplifica el proceso de obtener filas de un conjunto de resultados en forma de array.
    Usándola dentro de un bucle, se pueden procesar fácilmente los datos obtenidos en una consulta SQL.
    */
    function fetch_array($result){
        global $conexion;
        return mysqli_fetch_array($result);
    }


    //Sanear una cadena de texto antes de usarla en una consulta SQL, evitando posibles inyecciones SQL
    function escape($string){
        global $conexion;
        //Usa mysqli_real_escape_string para escapar caracteres especiales en la cadena $string
        return mysqli_real_escape_string($conexion, $string);
    }

