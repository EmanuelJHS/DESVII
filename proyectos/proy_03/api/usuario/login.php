<?php

    //encabezados obligatorios
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    //incluir archivos de conexion y objetos
    include_once '../configuracion/conexion.php';
    include_once '../objetos/usuario.php';

    //Obtener conexion a la base de datos
    $conex = new Conexion();
    $db = $conex->obtenerConexion();

    $usuario = new usuario($db);

    $data = json_decode(file_get_contents("php://input"));
    // echo "data: ". var_dump($data);

    if(
        !empty($data->user) &&
        !empty($data->pass) 
    ){

    $usuario->user = $data->user;
    $usuario->pass = $data->pass;

    $usuario->login();

    if($usuario->name!=null){
        //Creacion del arreglo
        $usuario_arr = array(
            "id" => $usuario->id,
            "id_colaborador" => $usuario->id_colaborador,
            "user" => $usuario->user,
            "pass" => $usuario->pass,
            "name" => $usuario->name,  
            "rol" => $usuario->rol,
            "estado" => $usuario->estado

        );

             // asignar codigo de respuesta - 200 OK
            http_response_code(200);
            // mostrarlo en formato json
            echo json_encode($usuario_arr);

    }else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Usuario no valido.")
        );

    }

}else{

    http_response_code(404);
    echo json_encode(
        array("message" => "Validar datos ingresados.")
    );

}




?>