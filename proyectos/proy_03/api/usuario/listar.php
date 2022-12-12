<?php

    //encabezados obligatorios
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");


        //incluir archivos de conexion y objetos
        include_once '../configuracion/conexion.php';
        include_once '../objetos/usuario.php';
    
        //Obtener conexion a la base de datos
        $conex = new Conexion();
        $db = $conex->obtenerConexion();
    
        $usuario = new usuario($db);
    
        $data = json_decode(file_get_contents("php://input"));
        // echo "data: ". var_dump($data);

        $stmt = $usuario->listar();

        $num = $stmt->rowCount();

        if($num>0){
            //arreglo de usuario
            
            $usuario_arr['records']=array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                $usuario_item = array(
                    "id" => $row['id'],
                    "id_colaborador" => $row['id_colaborador'],
                    "user" => $row['usuario'],
                    "name" => $row['nombre'],  
                    "rol" => $row['rol'],
                    "estado" => $row['estado']
                );

                array_push($usuario_arr['records'], $usuario_item);

            }
            
            //asignar codigo de respuesta - 200 OK
            http_response_code(200);

            //mostar productos en formato JSON
            echo json_encode($usuario_arr);

        }else{

            // no hay productos encontrados estara aqui
            // asignar codigo de respuesta - 404 No encontrado
            http_response_code(404);
            // informarle al usuario que no se encontraron actividades
            echo json_encode(
                array("message" => "No se encontraron registros.")
            );

        }


?>