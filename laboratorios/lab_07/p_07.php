<?php 
//Laboratorio 7.6: Uso de formularios en orientación a objetos 
if (array_key_exists('enviar', $_POST)){
    include('class_lib.php');

    $diam = $_POST['diam'];
    $altu = $_POST['altu'];

    $cil = new Cilindro($diam,$altu);

    $volumen=$cil->calc_volumen();
    $area=$cil->calc_area();

    echo "<br> El volumen del cilindro es de ".$volumen." metros cubicos";
    echo "<br> El area del cilindro es de ".$area." metros cuadrados";
}else{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laboratorio 7.6</title>
    </head>
    <body>
    <!-- Laboratorio 7.6: Uso de formularios en orientación a objetos  -->
    <form name="formularioDatos" method="post" action="p_07.php">
        <p> CALCULO DE VOLUMEN y AREA DE UN CILINDRO </p>
        <br/>
        Introduzca el diametro en metros: <input type="text" name="diam" value="">
            <br/> <br/>
        Introduzca la altura en metros: <input type="text" name="altu" value="">
        <br/> <br/>
        <input value="Calcular" name="enviar" type="submit" />
        </form>
    </body>
    </html>
    <?php
}

?>