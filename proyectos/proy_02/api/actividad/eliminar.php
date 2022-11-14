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

     //eliminar el actividad
      if($actividad->eliminar_actividad()){
                    //asignar codigo de respuesta - 200 satisfactorio
                    http_response_code(200);
    
                    //informar al usuario
                    echo json_encode(
                        array("message" => "La actividad ha sido eliminada")
                    );
                }else{
                    //asignar codigo de respuesta - 503 servicico no disponible
                    http_response_code(503);
            
                    //informar al usuario
                    echo json_encode(
                        array("message" => "No se puede eliminar la actividad.")
                    );
                }
    

?>