<?php

    //encabezados obligatorios
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    //incluir archivos de conexion y objetos
    include_once '../configuracion/conexion.php';
    include_once '../objetos/actividad.php';

    //Obtener conexion a la base de datos
    $conex = new Conexion();
    $db = $conex->obtenerConexion();

    //inicializar objeto
    $actividad =  new actividad($db);

    //lectura de actividad estara aqui
        
    //Obtener los datos
    $data = json_decode(file_get_contents("php://input"));

    //set ID property of record to read
    $actividad->id = isset($_GET['id']) ? $_GET['id']: die();

    //leer los detalles del producto a editar
    $actividad->consultar_actividades_1();

    if($actividad->tipo!=null){
        //Creacion del arreglo
        $actividad_arr = array(
            "id" => $actividad->id,
            "tipo" => $actividad->tipo,
            "titulo" => $actividad->titulo,
            "descripcion" => $actividad->descripcion,
            "ubicacion" => $actividad->ubicacion,  
            "correo" => $actividad->correo,
            "repetir" => $actividad->repetir,
            //
            "allday" => $actividad->allday,
            "dateIn" => $actividad->dateIn,
            "dateOut" => $actividad->dateOut,
            "timeIn" => $actividad->timeIn,
            "timeOut" => $actividad->timeOut

        );

             // asignar codigo de respuesta - 200 OK
            http_response_code(200);
            // mostrarlo en formato json
            echo json_encode($actividad_arr);

    }else{
        // no hay productos encontrados estara aqui
        // asignar codigo de respuesta - 404 No encontrado
        http_response_code(404);
        // informarle al usuario que no se encontraron productos
        echo json_encode(
            array("message" => "El actividad no existe.")
        );

    }



?>