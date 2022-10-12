<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="vAgregar.css">
    <title>Pruebas</title>
</head>
<body>
    <h1>Ventana para agregar una nueva nota</h1>
    <hr>
    <form name="NuevaActividad" action="" method="post">
        <div class="contenedor">

        <div class="fheader">
            <div>
            <label for="">Tipo:</label>
            <select name="tipo" id="tipo" onchange="tipoActividad()" >

                <option value="evento" selected>Evento</option>
                <option value="cumple" >Cumpleaños</option>
                <option value="aniversario">Aniversario</option>
            </select>
            </div>
            <input type="submit" name="guardar" value="Guardar" >
        </div>

        <div class="fbody">
            <label for="">Titulo:
            <input type="text" name="titulo" id="titulo" placeholder="titulo">
            </label>
            <br>
            <!-- Fecha de incio  y durancion -->
            <label for="">Inicio:
             <input type="date" name="date_inicio" id="date_inicio" onchange="calcularDuracion()" >
            <input type="time" name="time_inicio" id="time_inicio" onchange="calcularDuracion()" >
            </label>
            <br>
            <label for="">Fin
            <input type="date" name="date_fin" id="date_fin"  onchange="calcularDuracion()">
            <input type="time" name="time_fin" id="time_fin"  onchange="calcularDuracion()">
            <input type="text" name="duracion" id="duracion_d"  >
            <input type="text" name="duracion" id="duracion_h" >
            <label for="" id="lb_duracion" >duracion</label>
            <!-- hidden="true" -->

            </label>
            <br>

            <label for="">Repetir:
            <select name="repetir" id="repetir">
                <option value="once" selected>Una vez</option>
                <option value="daily" >Diariamente</option>
                <option value="weekly" >Semanal</option>
                <option value="monthly">Mensual</option>
                <option value="year">Anual</option>
            </select>
            </label>
            <label for="todoElDia">
                Todo el dia
                <input type="checkbox" name="allDay" id="allDay"  value="true" onchange="allDay_change()" >
            </label>

            <br>
            <input type="email" name="correo" id="correo" placeholder="correo@prueba.com">
            <br>
            <input type="text" name="ubicacion" id="ubicacion" placeholder="Ubicacion">
            <br>
            <textarea name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Descripcion"></textarea>        
        </div>

    </div>
    </form>

    <?php
    $dateIn = 'a';
    $timeIn;
    $dateOut = '';
    $timeOut;
    $allDay="";
    // strtotime() y date()
    function calcularFechas($f1,$f2){
        echo "<br><br>";
        $formato = "YYYY-mm-dd"; //formato de las fechas
        $fecha1 = new DateTime($f1);
        $fecha2 = new DateTime($f2);

        $intvl = $fecha1->diff($fecha2);
        echo $intvl->y." year, ". $intvl->m." months and ". $intvl->d ." day";
        echo "\n";
        echo $intvl->days . " days";
        //Para imprimir
        //$fecha1 = $fecha1->format($formato); //formateandolo
        // echo "Calcular las fechas: ";
        // echo $fecha1;


    }


    if(array_key_exists('guardar',$_POST)){
        echo 'Tipo: '.$_REQUEST['tipo']."<br>";
        echo 'Titulo: '.$_REQUEST['titulo']."<br>";
        echo "Inicio<br>";
        echo 'Date_in: '.$_REQUEST['date_inicio']."<br>";
        $GLOBALS['dateIn'] = $_REQUEST['date_inicio'];

        echo 'Correo: '.$_REQUEST['correo']."<br>";
        echo 'Ubicacion: '.$_REQUEST['ubicacion']."<br>";
        echo 'Descripcion: '.$_REQUEST['descripcion']."<br>";
        echo '<br>';



        if($_REQUEST['tipo']=='evento'and array_key_exists('allDay',$_POST) == false  ){  
            //Para obtener (time_inicio, time_fina, date_fin)
            echo 'Time_in: '.$_REQUEST['time_inicio']."<br>";
            echo "Fin:<br>";

            echo 'Date_out: '.$_REQUEST['date_fin']."<br>";
            $GLOBALS['dateOut'] =  $_REQUEST['date_fin'];


            echo 'Time_out: '.$_REQUEST['time_fin']."<br>";
            echo 'Repetir: '.$_REQUEST['repetir']."<br>";
           echo 'Todo el dia: false <br';

        }else{
            //para obtener (repetir, todo el dia)
            //Podemo asusmir que sera anual y todo el dia.
            echo 'Repetir: year';
            echo '<br>';
            echo 'Todo el dia: true';
        };

        echo "<br><br>";
        echo "Realizando calculos:";
        echo "<br>";
        echo "dateIn:". $GLOBALS['dateIn'];
        echo "<br>";
        echo "dateOut:".$GLOBALS['dateOut'];
        echo "<br>";

        calcularFechas($GLOBALS['dateIn'],$GLOBALS['dateOut']);

       }

    




    ?>
    <script src="http://momentjs.com/downloads/moment.min.js"></script>
    <script src="agregar.js"></script>
</body>
</html>