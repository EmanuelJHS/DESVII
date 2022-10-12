<?php

if(array_key_exists('enviar',$_POST)){
    $expire = time()+60*5;
    setcookie("user",$_REQUEST['visitante'], $expire);
    header("Refresh:0");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Laboratorio 13</title>
</head>
<body>
    <h1>Creacion de cookies</h1>
    <h2>La coockie "User" tendra solo 5 minutos de duracion</h2>
    <?php
    
        if(isset($_COOKIE["user"])){
            print("<br>Hola <b>".$_COOKIE['user']."</b> gracias por visitar nuestro sitio web<br> ");
        }else{
            ?>
            <form name="formcookie" method="post" action="p_02.php">
                <br>Hola, primera vez que te vemos por nuestro sitio web. Como te llamas?
                <input type="text" name="visitante">
                <input name="enviar" value="Gracias por indentificarte" type="submit"><br>

            </form>

            <?php

        }

    
    ?>
    <br><a href="p_03.php">Continuar...</a>
</body>
</html>