<?php

    //encabezados obligatorios
    header("Acces-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Header, Authorization, X-Requested-With");

        //incluir archivos de conexion y objetos
        include_once '../configuracion/conexion.php';
        include_once '../objetos/marcacion.php';

        //inicializar base de datos y objeto producto
        $conex = new Conexion();
        $db = $conex->obtenerConexion();

        $marcacion = new marcacion($db);

        $data = json_decode(file_get_contents("php://input"));

        if(
            !empty($data->id) &&
            !empty($data->fecha) &&
            !empty($data->hora)
        ){
            $marcacion->id = $data->id;
            $marcacion->fecha = $data->fecha;
            $marcacion->hora = $data->hora;

            if($marcacion->actualizar()){
                http_response_code(201);
                echo json_encode(
                    array("message" => "Se ha actualizado marcacion Correctamente")
                );
            }else{
                http_response_code(503);
                echo json_encode(
                    array("message" => "No se puede actualizar la marcacion.")
                );
            }

        }else{
            http_response_code(404);
            echo json_encode(
                array("message" => "Datos incompletos.")
            );
        }

?>
