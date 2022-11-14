<?php

    //encabezados obligatorios
    header("Acces-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Header, Authorization, X-Requested-With");

        //incluir archivos de conexion y objetos
        include_once '../configuracion/conexion.php';
        include_once '../objetos/actividad.php';

        //inicializar base de datos y objeto producto
        $conex = new Conexion();
        $db = $conex->obtenerConexion();
            
        //inicializar objeto
        $actividad =  new actividad($db);
        
        //lectura de actividad estara aqui
        
        //Obtener los datos
        $data = json_decode(file_get_contents("php://input"));


        //asegurar que los datos no esten vacios
        if(
            !empty($data->id) &&
            !empty($data->tipo) &&
            !empty($data->titulo) &&
            !is_null($data->ubicacion) &&
            !is_null($data->descripcion) &&
            !is_null($data->correo) &&
            !empty($data->repetir) &&
            !empty($data->allday) &&
            !empty($data->dateIn) &&
            !empty($data->dateOut) 
        ){

            //asignar valores de propiedad
            $actividad->id = $data->id;
            $actividad->tipo = $data->tipo;
            $actividad->titulo = $data->titulo;
            $actividad->ubicacion = $data->ubicacion;
            $actividad->descripcion = $data->descripcion;
            $actividad->correo = $data->correo;
            $actividad->repetir = $data->repetir;
            $actividad->allday = $data->allday;
            //
            $actividad->dateIn = $data->dateIn;
            $actividad->dateOut = $data->dateOut;

            //crear el actividad
            if($actividad->actualizar_actividad()){
                //asignar codigo de respuesta - 200 satisfactorio
                http_response_code(200);

                //informar al usuario
                echo json_encode(
                    array("message" => "La actividad ha sido actualizada")
                );
            }else{
                //Si no puede crear el producto, informar al usuario
                //asignar codigo de respuesta - 503 servicico no disponible
                http_response_code(503);
        
                //informar al usuario
                echo json_encode(
                    array("message" => "No se puede actualizar la actividad.")
                );
            }

        }else{
                //informar al usuario que los datos estan incompletos
                http_response_code(400);

                //informar al usuario
                echo json_encode(
                    array("message" => "Datos estan incompletos.")
                );


        }    
        

?>