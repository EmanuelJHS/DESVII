<?php

    //encabezados obligatorios
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    //la conexion a la base de datos estara aqui
    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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
            !empty($data->dateIn) &&
            !empty($data->dateOut)
        
        ){

            //asignar valores de propiedad a producto
            $actividad->dateIn = $data->dateIn.' 00:00:00';
            $actividad->dateOut = $data->dateOut.' 23:59:59';

            //query  actividades
            $stmt = $actividad->consultar_actividades();

            $num = $stmt->rowCount();

            //verificar si hay mas de 0 registros encontrados
            if($num>0){
                //arreglo de productos
                $actividades_arr=array();
                $actividades_arr['records']=array();

                 //obtiene todo el contenido de la tabla
                //fetch() es mas rapido que fetchAll()
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                    //extraer fila
                    // esto creara de $row['nombre'] a
                    //solamente $nombre


                    $actividad_item = array(
                        "id"=> $id,
                        "tipo"=> $tipo,
                        "titulo"=> $titulo,
                        "ubicacion"=> $ubicacion,
                        "descripcion"=> $descripcion,
                        "correo"=> $correo,
                        "repetir"=> $repetir,
                        "allday"=> $allday,
                        "fecha_in"=> $fecha_in,
                        "fecha_out"=> $fecha_out
                    );

                    array_push($actividades_arr['records'], $actividad_item);

                }
                
                //asignar codigo de respuesta - 200 OK
                http_response_code(200);

                //mostar productos en formato JSON
                echo json_encode($actividades_arr);

            }else{

                // no hay productos encontrados estara aqui
                // asignar codigo de respuesta - 404 No encontrado
                http_response_code(404);
                // informarle al usuario que no se encontraron actividades
                echo json_encode(
                    array("message" => "No se encontraron Actividades.")
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