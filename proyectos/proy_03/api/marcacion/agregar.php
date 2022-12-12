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
                
            //inicializar objeto
            $marcacion = new marcacion($db);

            $data = json_decode(file_get_contents("php://input"));

            if(
                !empty($data->id_colaborador) &&
                !empty($data->fecha) &&
                !empty($data->hora)
            ){
                $marcacion->id_colaborador = $data->id_colaborador;
                $marcacion->fecha = $data->fecha;
                $marcacion->hora = $data->hora;


                if($marcacion->agregar()){
                    http_response_code(201);
                    echo json_encode(
                        array("message" => "Se ha agregado marcacion Correctamente")
                    );
                }else{
                    http_response_code(503);
                    echo json_encode(
                        array("message" => "No se puede crear la marcacion.")
                    );
                }

            }else{
                http_response_code(404);
                echo json_encode(
                    array("message" => "Datos incompletos.")
                );
            }

?>