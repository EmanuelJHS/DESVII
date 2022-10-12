<?php
    if(isset($_COOKIE['contador'])){
        setcookie('contador',$_COOKIE['contador']+1,time()+365*24*60*60);
        $mensaje = 'Gracias por visitarme. Numero de visitas: '.$_COOKIE['contador'];

    }else{
        //caduca en one year
        setcookie('contador',1,time()+365*24*60*60);
        $mensaje = 'Bienvenido a nuestro sitio web';

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
    <h1>Contador de visitas con Cookies</h1>
    <h3>
        <?php
            echo $mensaje;
        ?>
    </h3>
    
</body>
</html>
