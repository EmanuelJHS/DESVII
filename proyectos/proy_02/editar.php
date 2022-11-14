<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="vAgregar.css">
    <title>Agenda</title>
</head>
<body>
    <h1>Editar actividad</h1>
    <hr>
    
<?php 

// echo "Variable de session: ". $_SESSION['a_editar'];
// session_destroy(); 

require_once("class/actividades.php");
require_once("class/actividad_modelo.php");


//Funciones
function indexTipo($i){
    $resultado=0;
    switch ($i) {
        case "evento":
            $resultado=0;
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


//Pagina
$card_actividad = new actividad_modelo();
        
if(isset($_SESSION['a_editar'])){

    // $obj_actividad = new actividades();
    // $actividades = $obj_actividad->consultar_actividades_1($_SESSION['a_editar']);
    
    $id = $_SESSION['a_editar'] ;
    $resultado =  json_decode(file_get_contents('http://localhost/DESVII/proyectos/proy_02/api/actividad/leer_uno.php?id='.$id.''),true);

    $actividades = [$resultado];
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
            //$card_actividad->setRepetir($resultado['repetir']);
            $card_actividad->setallDay($resultado['allday']);
            $card_actividad->setDateIn(substr($resultado['dateIn'], 0,10));
            $card_actividad->setDateOut(substr($resultado['dateOut'], 0,10));
            $card_actividad->setTimeIn(substr($resultado['timeIn'],11,5));
            $card_actividad->setTimeOut(substr($resultado['timeOut'],11,5));
    

        }
    }else{
        print("No hay actividades, favor de agregar");
    }

    //echo"<p>Probando: ".$card_actividad->getallDay()."</p>"; //date

    //Imprimiendo plantilla
    //echo '';  
    ?>
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
            <input type="text" name="titulo" id="titulo" placeholder="titulo"  value= "" required >
            </label>
            <br>
            <!-- Fecha de incio  y durancion -->
            <label for="">Inicio:
             <input type="date" name="date_inicio" id="date_inicio" onchange="calcularDuracion()" >
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
            <input type="email" name="correo" id="correo" placeholder="correo@prueba.com" value="">
            <br>
            <input type="text" name="ubicacion" id="ubicacion" placeholder="Ubicacion" value="">
            <br>
            <textarea name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Descripcion"></textarea>        
        </div>

    </div>
    </form>
    <?php  
    //acttiones
    if(array_key_exists('guardar',$_POST)){
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
            $time_in = $_REQUEST['time_inicio'];
            $date_out = $_REQUEST['date_fin'];
            $time_out = $_REQUEST['time_fin'];
            $repetir = "once";
            $allday = "false";
        }else{
            $time_in = "00:00:00";
            $time_out = "23:59:59";
            $date_out = $date_in;
            $repetir = "once";
            $allday = "true";
        };

        $date_in = $date_in." ".$time_in;
        $date_out = $date_out." ".$time_out;


        $data = array(
            'id'=> $_SESSION['a_editar'],
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
            CURLOPT_URL => 'http://localhost/DESVII/proyectos/proy_02/api/actividad/actualizar.php',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $post_Data,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json')
        );
    
        curl_setopt_array($ch,$options);
        $result = curl_exec($ch);
        curl_close($ch);

        session_destroy();

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
        header("Location: ./resumen.php");
    }



}
    ?>
    <script>

    let _tipo = document.getElementById("tipo");
    _tipo.selectedIndex = <?php echo $card_actividad->getTipo() ?>;
    let _repetir = document.getElementById('repetir');
    _repetir.selectedIndex = '<?php echo $card_actividad->getRepetir() ?>';
    let _titulo = document.getElementById("titulo");
    _titulo.value = '<?php echo  $card_actividad->getTitulo() ?>';
    let _correo = document.getElementById("correo");
    _correo.value = '<?php echo  $card_actividad->getCorreo() ?>';
    let _ubicacion = document.getElementById("ubicacion");
    _ubicacion.value = '<?php echo  $card_actividad->getUbicacion() ?>';
    let _descripcion = document.getElementById("descripcion");
    _descripcion.value = '<?php echo  $card_actividad->getDescripcion() ?>';

    let _dateIn = document.getElementById("date_inicio");
    _dateIn.value = '<?php echo  $card_actividad->getDateIn() ?>';
    let _timeIn = document.getElementById("time_inicio");
    _timeIn.value = '<?php echo  $card_actividad->getTimeIn() ?>';

    let _dateOut = document.getElementById("date_fin");
    _dateOut.value = '<?php echo  $card_actividad->getDateOut() ?>';
    let _timeOut = document.getElementById("time_fin");
    _timeOut.value = '<?php echo  $card_actividad->getTimeOut() ?>';

    //set CheckBox
    let bo = <?php echo  $card_actividad->getAllDay() ?>;
    let cballDay = document.getElementById('allDay');
    if( bo > 0 ){
        cballDay.checked = true;
    }else{
        cballDay.checked = false;
    }


    </script>
        <script src="http://momentjs.com/downloads/moment.min.js"></script>
        <script src='editar.js'></script>

        </body>
</html>
