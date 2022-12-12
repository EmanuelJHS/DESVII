<?php

    //encabezados obligatorios
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    //incluir archivos de conexion y objetos
    include_once '../configuracion/conexion.php';
    include_once '../objetos/marcacion.php';

    //Obtener conexion a la base de datos
    $conex = new Conexion();
    $db = $conex->obtenerConexion();

    $marcacion = new marcacion($db);

    $data = json_decode(file_get_contents("php://input"));
    //echo "data: ". var_dump($data);

    if(
        !empty($data->id_colaborador)
    ){

    $marcacion->id_colaborador = $data->id_colaborador;

    $stmt = $marcacion->select_last();

    $num = $stmt->rowCount();

    if($num>0){
        $marcacion_arr=array();
        $marcacion_arr['records']=array();


        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $marcacion_item = array(
                "id_colaborador" => $id_colaborador,
                "nombre" => $nombre,
                "fecha" => $fecha,
                "hora" => $hora
    
            );

            array_push($marcacion_arr['records'], $marcacion_item);

        }
             // asignar codigo de respuesta - 200 OK
            http_response_code(200);
            // mostrarlo en formato json
            echo json_encode($marcacion_arr);

    }else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No se encontraron marcaciones.")
        );

    }

}else{

    http_response_code(404);
    echo json_encode(
        array("message" => "Datos estan incompletos.")
    );

}




?>