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

        $card_actividad = new actividad_modelo();
        $obj_actividad = new actividades();
        $actividades = $obj_actividad->consultar_actividades(''.$dia.' 00:00:00', ''.$dia.' 23:59:59' ); //Recuerda enviar la dateIn and dateOut

        $nfilas = count($actividades);

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
                $card_actividad->imprimirPlantillaResumen();
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
            //echo "Eliminar: ". $_REQUEST['aid'];
            ?>
            <!-- <script>

                if(confirm("¿Desea la actividad?")){ -->
                    <?php
                    $obj_actividad = new actividades();
                    $actividades = $obj_actividad->eliminar_actividad($_REQUEST['aid']);
                    ?>
            <!--      }else{

                }
             </script> -->
            <?php
        }

    ?>

    <script src="js/resumen.js"></script>
</body>
</html>