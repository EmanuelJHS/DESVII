<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Laboratorio 12</title>
</head>
<body>
    <h1>Manejo de sesiones</h1>
    <h2>Paso 2: Se accede a la variable de sesion almacenada y se destruye</h2>

    <?php


        if(isset($_SESSION['var'])){
            $var = $_SESSION['var'];
            print("<p>Valor de la variable de sesion: $var</p>\n");
            unset($_SESSION['var']);
            print("<a href='p_03.php'>Paso 3</a>");
        }else{
            print("Sesion no inciada, ir al <a href='p_01.php'>Paso 1</a>, para iniciar la sesion.");
        }
    ?>
    
</body>
</html>