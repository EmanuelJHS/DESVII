<?php
//inicio de sesion
 session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
</head>
<body>
    <h1>Resumen del dia</h1>
    <hr>
    <form action="resumen.php" name="formResumen" method="POST" id="fResumen">
        <input type="date" name="dateIn" id= "pickerDate" onchange="enviarDatos()">
        <input type="submit" name="btn_agregar" value="Agregar">
        <input type="submit" name="btn_reporte" value="Reporte">
    </form>
     

    <?php

        require_once("class/actividades.php");
        require_once("class/actividad_modelo.php");


        //Funciones
        function indexTipo($i){
            $resultado="";
            switch ($i) {
                case "evento":
                    $resultado="Evento";
                    break;
                case "cumple":
                    $resultado="Cumpleaños de";
                    break;
                case "aniversario":
                    $resultado="Aniversario de";
                    break;
            }
            return $resultado;
        }

        
        function imprimirPlantillaResumen($obj_a){
            echo '
            <form method="post" action="resumen.php">    
            <div class="actividad_card" style="border: solid 1px aquamarine">
            <label for="" id="tipo">'.$obj_a->getTipo().'</label>
            <label for="" id="titulo">'.$obj_a->getTitulo().'</label>
            <br>
            <label for="" id="dateIn">'.$obj_a->getDateIn().'</label>
            <label for="">  ->  </label>
            <label for="" id="dateOut">'.$obj_a->getDateOut().'</label>
            <input type="text" name="aid" id="aid" value='.$obj_a->getId().' hidden="true">
            <input type="submit" name="btn_detalle" value="Detalle">
            <input type="submit" name="btn_editar" value="Editar" >
            <input type="submit" name="btn_eliminar" value="Eliminar">
            </div>
            </form>';
            
        }


        date_default_timezone_set('America/Panama'); //Se estable la zona horario
        $DateAndTime = date('Y-m-d H:i:s ', time()); //Se obtiene la fecha
        //echo "The current date and time are $DateAndTime.";
        $dia = substr($DateAndTime,0,10);

        if(array_key_exists("dateIn", $_POST)){
            $dia = $_REQUEST['dateIn'];
        }

        echo"<script>
        let pickerDate = document.getElementById('pickerDate');
        pickerDate.value = '".$dia."'
        </script>";

        //Conectando a la Api
        $data = array(
            'dateIn'=>''.$dia.'',
            'dateOut'=>''.$dia.''
    
        );
        $post_Data = json_encode($data);
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => 'http://localhost/DESVII/proyectos/proy_02/api/actividad/leer.php',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $post_Data,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json')
        );
    
        curl_setopt_array($ch,$options);
        $result = curl_exec($ch);
        curl_close($ch);

        //Transformando a arreglo, la respusta
        $response = json_decode($result,true);
        $actividades = $response['records'];

        $nfilas = count($actividades);

        $card_actividad = new actividad_modelo();

        if ($nfilas > 0){
                echo "<ul>";
             foreach ($actividades as $resultado){
                echo "<li>";
                $card_actividad->setId($resultado['id']);
                $card_actividad->setTipo(indexTipo($resultado['tipo']));
                $card_actividad->setTitulo($resultado['titulo']);
                $card_actividad->setUbicacion($resultado['ubicacion']);
                $card_actividad->setDescripcion($resultado['descripcion']);
                $card_actividad->setCorreo($resultado['correo']);
                $card_actividad->setRepetir($resultado['repetir']);
                $card_actividad->setallDay($resultado['allday']);
                $card_actividad->setDateIn($resultado['fecha_in']);
                $card_actividad->setDateOut($resultado['fecha_out']);

                // print ("<td>".$resultado['titulo']."</td>\n");
                // print ("<td>".date("j/n/Y",strtotime($resultado['fecha']))."</td>\n");
                imprimirPlantillaResumen($card_actividad);
                echo "</li>";
             }
            
                echo "</ul>";

            // print ("</table>\n");
        }else{
            echo "<div class='mensaje'>No hay actividades, favor de agregar</div>";
        }


        if(array_key_exists('btn_detalle',$_POST)){
            //echo "Editar: ". $_REQUEST['aid'];
            $_SESSION['a_editar'] = $_REQUEST['aid']; //Pasando variable
            ?>
            <script>
                window.location.href="detalles.php";
            </script>
            <?php
        }

        if(array_key_exists('btn_editar',$_POST)){
            //echo "Editar: ". $_REQUEST['aid'];
            $_SESSION['a_editar'] = $_REQUEST['aid']; //Pasando variable
            ?>
            <script>
                window.location.href="editar.php";
            </script>
            <?php
        }

        if(array_key_exists('btn_agregar',$_POST)){
            ?>
            <script>
                window.location.href="agregar.php";
            </script>
            <?php
        }

        
        if(array_key_exists('btn_reporte',$_POST)){
            ?>
            <script>
                window.location.href="reporte.php";
            </script>
            <?php
        }

        if(array_key_exists('btn_eliminar',$_POST)){
            // $obj_actividad = new actividades();
            // $actividades = $obj_actividad->eliminar_actividad($_REQUEST['aid']);
            $id = $_REQUEST['aid'] ;
            json_decode(file_get_contents('http://localhost/DESVII/proyectos/proy_02/api/actividad/eliminar.php?id='.$id.''),true);
            header("Location: resumen.php");

        }

    ?>

    <script src="js/resumen.js"></script>
</body>
</html>