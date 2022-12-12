<?php

    //encabezados obligatorios
    header("Acces-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Header, Authorization, X-Requested-With");

        //incluir archivos de conexion y objetos
        include_once '../configuracion/conexion.php';
        include_once '../objetos/usuario.php';

        //inicializar base de datos y objeto producto
        $conex = new Conexion();
        $db = $conex->obtenerConexion();

        $usuario = new usuario($db);

        $data = json_decode(file_get_contents("php://input"));

        if(
            !empty($data->id) &&
            !empty($data->pass) &&
            !empty($data->name) &&
            !empty($data->rol) &&
            !empty($data->estado)
        ){
            $usuario->id = $data->id;
            $usuario->pass = $data->pass;
            $usuario->name = $data->name;
            $usuario->rol = $data->rol;
            $usuario->estado = $data->estado;

            if($usuario->actualizar()){
                http_response_code(201);
                echo json_encode(
                    array("message" => "Se ha actualizado usuario Correctamente")
                );
            }else{
                http_response_code(503);
                echo json_encode(
                    array("message" => "No se puede actualizar el usuario.")
                );
            }

        }else{
            http_response_code(404);
            echo json_encode(
                array("message" => "Datos incompletos.")
            );
        }

?>
