<?php  session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/detalles.css">
    <title>Agenda</title>
</head>
<body>
    <h1>Detalles</h1>
    <hr>
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

        function indexRepetir($i){
            $resultado=0;
            switch ($i) {
                case "once":
                    $resultado=0;
                    break;
                case "daily":
                    $resultado=1;
                    break;
                case "weekly":
                    $resultado=2;
                    break;
                case "monthly":
                    $resultado=3;
                    break;
                case "yearly":
                    $resultado=4;
                    break;
            }
            return $resultado;
        }


     $card_actividad = new actividad_modelo();

    if(isset($_SESSION['a_editar'])){

        $obj_actividad = new actividades();
        $actividades = $obj_actividad->consultar_actividades_1($_SESSION['a_editar']);
        

        
        $nfilas = count($actividades);
        
        if ($nfilas > 0){
            foreach ($actividades as $resultado){
                $card_actividad->setId($resultado['id']);
                $card_actividad->setTipo(indexTipo($resultado['tipo'])); //Con funcion
                $card_actividad->setTitulo($resultado['titulo']);
                $card_actividad->setUbicacion($resultado['ubicacion']);
                $card_actividad->setDescripcion($resultado['descripcion']);
                $card_actividad->setCorreo($resultado['correo']);
                $card_actividad->setRepetir(indexRepetir($resultado['repetir']));
                $card_actividad->setallDay($resultado['allday']);
                $card_actividad->setDateIn(substr($resultado['fecha_in'], 0,10));
                $card_actividad->setDateOut(substr($resultado['fecha_out'], 0,10));
                $card_actividad->setTimeIn(substr($resultado['fecha_in'],11,5));
                $card_actividad->setTimeOut(substr($resultado['fecha_out'],11,5));
        
    
            }
        }else{
            print("No hay actividades, favor de agregar");
        }

        if(array_key_exists('atras',$_POST)){
            ?>
            <script>
                window.location.href="resumen.php";
            </script>
            <?php
            session_destroy();
        }

        //Imprimiendo plantilla
        echo '    <div>
        <form action="detalles.php" method="post" name="formDetalles">
            <input type="submit" name="atras" value="Atras">
        </form>
        <h1 id="tipo">'.$card_actividad->getTipo().'</h1>
        <h2 id="titulo">'.$card_actividad->getTitulo().'</h1>

        <div class="time">
            <label for="">De: </label>
            <label for="" id="dateIn"> '.$card_actividad->getDateIn().'</label> 
            <label for="" id="timeIn" > '.$card_actividad->getTimeIn().'</label>
        </div>

        <div class="time">
            <label for="">Hasta: </label>
            <label for="" id="dateOut" > '.$card_actividad->getDateOut().'</label>
            <label for="" id="timeOut" > '.$card_actividad->getTimeOut().'</label>
        </div>

        <label for="" id="correo">Correo: '.$card_actividad->getCorreo().'</label>
        <br>
        <label for="" id="ubicacion">Ubicacion: '.$card_actividad->getUbicacion().'</label>
        <br>
        <label for="" id="descripcion">Descripcion: '.$card_actividad->getDescripcion().'</label>

        </div>';

    }

    ?>

    <?php

    ?>

</body>
</html>