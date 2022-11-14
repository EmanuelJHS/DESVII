<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
</head>
<body>
    <h1>Reporte</h1>
    <hr>
    <a href="resumen.php">Regresar</a>
    <form action="reporte.php" method="post" name="formReporte">
    <input type="date" name="fecha" id="fecha">

    <div>
    <label for="">Tipo:</label>
        <select name="tipo" id="tipo">
            <option value="evento">Evento</option>
            <option value="cumple">Cumpleaños</option>
            <option value="aniversario">Aniversario</option>
            <!-- <option value="todos">Todos</option> -->
        </select>
    </div>

    <div>
    <label for="">Rango: </label>
        <select name="rango" id="rango">
            <option value="dia">Dia</option>
            <option value="semana">Semana</option>
            <option value="mes">Mes</option>
            <option value="año">Año</option>
        </select>
    </div>

    <input type="submit" value="Enviar" name="enviar">
    </form>

    <?php

        require_once("class/actividades.php");
        require_once("class/actividad_modelo.php");

        if(array_key_exists('enviar',$_POST)){
           
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

            function getIndexTipo($i){
                $resultado="";
                switch ($i) {
                case "evento":
                    $resultado= 0;
                    break;
                case "cumple":
                    $resultado=1;
                    break;
                case "aniversario":
                    $resultado=2;
                    break;
                }
                return $resultado;
            }

            function getIndexRango($i){
                $resultado="";
                switch ($i) {
                case "dia":
                    $resultado= 0;
                    break;
                case "semana":
                    $resultado=1;
                    break;
                case "mes":
                    $resultado=2;
                    break;
                case "año":
                    $resultado=3;
                    break;
                }
                return $resultado;
            }

            //Mantemos el valor del variable en su lugar
            $tipo = $_REQUEST['tipo'];
            $rango = $_REQUEST['rango'];
            $dia = $_REQUEST['fecha'];

            echo"<script>
            let pickerDate = document.getElementById('fecha');
            pickerDate.value = '".$dia."'
            let tipo = document.getElementById('tipo');
            tipo.selectedIndex = '".getIndexTipo($tipo)."'
            let rengo = document.getElementById('rango');
            rango.selectedIndex = '".getIndexRango($rango)."'
            </script>";

            function setFechas($s){

                $arg = array();
                switch($s){
                    case "dia":
                        $arg["in"] = $_REQUEST["fecha"];
                        $arg["out"] = $_REQUEST["fecha"];
                        break;
                    case "semana":
                        $fecha = $_REQUEST["fecha"];
                        $time = strtotime($fecha);
                        $ndia = date("N",$time)-1;
                        if($ndia>1){
                            $arg['in'] = date("Y-m-d", strtotime($fecha.' - '.$ndia.' days')); //Primer dia de la semana
                            $arg['out'] = date("Y-m-d", strtotime($arg['in'].' + 6 days'));; //Ultimo dia de la semana
                        }else{
                            $arg['in'] = $fecha;
                            $arg['out'] = date("Y-m-d", strtotime($arg['in'].' + 6 days'));;
                        }
                        break;
                    case "mes":
                        $arg["in"] = substr($_REQUEST["fecha"],0,8). "01";
                        $today = strtotime($_REQUEST["fecha"]); //Transforma a tiempo
                        $lastday = date("Y-m-t", $today); // t = cantidad de dias que tiene el mes dado.
                        $arg["out"] = $lastday;
                        break;
                    case "año":
                        $year = substr($_REQUEST["fecha"],0,4);
                        $arg["in"] = $year. "-01-01";
                        $arg["out"] =   $year. "-12-31" ;                               
                        break;

                }
                return $arg;
            }


            $fechas = setFechas($rango);
            echo  $fechas['in']."  \  ".$fechas['out'];

            //Imprimiendo reporte
            $card_actividad = new actividad_modelo();
            $obj_actividad = new actividades();
            
            $actividades = $obj_actividad->consultar_actividades_filtro( $tipo.'',''.$fechas['in'].' 00:00:00', ''.$fechas['out'].' 23:59:59' ); //Recuerda enviar la dateIn and dateOut

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

        }

    ?>


</body>
</html>