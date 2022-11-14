<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="vAgregar.css">
    <title>Agenda</title>
</head>
<body>
    <h1>Agregar actividad</h1>
    <hr>
    <form name="NuevaActividad" action="" method="post">
        <div class="contenedor">

        <div class="fheader">
            <div>
            <label for="">Tipo:</label>
            <select name="tipo" id="tipo" onchange="tipoActividad()" require >

                <option value="evento" selected>Evento</option>
                <option value="cumple" >Cumpleaños</option>
                <option value="aniversario">Aniversario</option>
            </select>
            </div>
            <input type="submit" name="guardar" value="Guardar" >
            <input type="submit" name="cerrar" value="Cerrar" onclick="cerrarVentana()">
        </div>

        <div class="fbody">
            <label for="">Titulo:
            <input type="text" name="titulo" id="titulo" placeholder="titulo" required>
            </label>
            <br>
            <!-- Fecha de incio  y durancion -->
            <label for="">Inicio:
             <input type="date" name="date_inicio" id="date_inicio" onchange="calcularDuracion()" required >
            <input type="time" name="time_inicio" id="time_inicio" onchange="calcularDuracion()" >
            </label>
            <label for="">=> Fin: 
            <input type="date" name="date_fin" id="date_fin"  onchange="calcularDuracion()" >
            <input type="time" name="time_fin" id="time_fin"  onchange="calcularDuracion()" >
            <label for="" id="lb_duracion" >duracion</label>
            <!-- hidden="true" -->

            </label>
            <br>

            <label for="">Repetir:
            <select name="repetir" id="repetir" disabled="true">
                <option value="once" selected>Una vez</option>
                <option value="daily" >Diariamente</option>
                <option value="weekly" >Semanal</option>
                <option value="monthly">Mensual</option>
                <option value="yearly">Anual</option>
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
    require_once('class/actividades.php');
    


    if(array_key_exists('guardar',$_POST)){

        // echo 'Tipo: '.$_REQUEST['tipo']."<br>";
        // echo 'Titulo: '.$_REQUEST['titulo']."<br>";
        // echo 'Date_in: '.$_REQUEST['date_inicio']."<br>";
        // echo 'Correo: '.$_REQUEST['correo']."<br>";
        // echo 'Ubicacion: '.$_REQUEST['ubicacion']."<br>";
        // echo 'Descripcion: '.$_REQUEST['descripcion']."<br>";

        $tipo = $_REQUEST['tipo'];
        $titulo = $_REQUEST['titulo'];
        $date_in= $_REQUEST['date_inicio'];
        $correo = $_REQUEST['correo'];
        $ubicacion = $_REQUEST['ubicacion'];
        $descripcion = $_REQUEST['descripcion'];

        $time_in;
        $date_out;
        $time_out;
        $repetir;
        $allday;

        if($_REQUEST['tipo']=='evento'and array_key_exists('allDay',$_POST) == false  ){  
            //Para obtener (time_inicio, time_fina, date_fin)
            // echo 'Time_in: '.$_REQUEST['time_inicio']."<br>";
            // echo 'Date_out: '.$_REQUEST['date_fin']."<br>";
            // echo 'Time_out: '.$_REQUEST['time_fin']."<br>";
            // echo 'Repetir: '.$_REQUEST['repetir']."<br>";
            // $repetir = $_REQUEST['repetir'];

            $time_in = $_REQUEST['time_inicio'];
            $date_out = $_REQUEST['date_fin'];
            $time_out = $_REQUEST['time_fin'];
            $repetir = "once";
            $allday = "false";
            //    echo 'Todo el dia: ',$allday,' <br';


        }else{
            //para obtener (repetir, todo el dia)
            //Podemo asusmir que sera anual y todo el dia.
            $time_in = "00:00:00";
            $time_out = "23:59:59";
            $date_out = $date_in;
            $repetir = "once";
            $allday = "true";

            // echo 'Repetir: year';
            // echo '<br>';
            // echo 'Todo el dia: true';
        };

        // echo "<br>Segunda impresion:  <br>";
        // echo " 
        // tipo: ",$tipo,"<br> 
        // titulo: ",$titulo,"<br>
        // date_in: ",$date_in,"<br>
        // correo: ",$correo,"<br>
        // ubicacion: ",$descripcion,"<br>
        // date_in: ",$date_in,"<br>

        // time_in: ",$time_in,"<br>
        // date_out: ",$date_out,"<br>
        // time_out: ",$time_out,"<br>
        // repetir: ",$repetir,"<br>
        // allday: ",$allday,"<br>
        // ";

        $date_in = $date_in." ".$time_in;
        $date_out = $date_out." ".$time_out;

        //Conectando a la Api
        $data = array(
            'tipo'=>''.$tipo.'',
            'titulo'=>''.$titulo.'',
            'ubicacion'=>''.$ubicacion.'',
            'descripcion'=>''.$descripcion.'',
            'correo'=>''.$correo.'',
            'repetir'=>''.$repetir.'',
            'allday'=>''.$allday.'',
            'dateIn'=>''.$date_in.'',
            'dateOut'=>''.$date_out.''
    
        );
        $post_Data = json_encode($data);
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => 'http://localhost/DESVII/proyectos/proy_02/api/actividad/crear.php',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $post_Data,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json')
        );
    
        curl_setopt_array($ch,$options);
        $result = curl_exec($ch);
        curl_close($ch);




        if($result>0){
            ?>
            <script>
                window.location.href="resumen.php"; //para cambiar de ventana.
                alert("Se ha guardado correctamente.") //Darle un mensaje al usuario.
            </script>
            <?php
                }else{
            ?>
            <script>
                window.location.href="resumen.php";
                alert("Se produjo un error, intente mas tarde.")
            </script>
            <?php


       }

    }

    if(array_key_exists('cerrar',$_POST)){
        ?>
        <script>
            window.location.href="resumen.php";
        </script>
        <?php
    }

    ?>
    <script src="http://momentjs.com/downloads/moment.min.js"></script>
    <script src="agregar.js"></script>
</body>
</html>