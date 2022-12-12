
<?php
 include_once("..//lib/utility.php");
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main_co.css">
    <title>Document</title>
</head>
<body>

<?php

    // mostar nombre del usuario
    // boton para cerrar sesion y mandar al login
    // si no esta logged, mandar al login 
    // mostrar ultima marcacion realizada por el usuario, si no tiene no mostrar nada
    // boton para registrar marcacion 
    // mostrar la fecha y la hora de cuando se realizo la marcacion 


    if(isset($_SESSION['user_logged'])){

        $url = 'http://localhost/DESVII/proyectos/proy_03/api/usuario/login.php';
        $data = array(
            'user'=>''.$_SESSION['user_logged'].'',
            'pass'=>''.$_SESSION['pass_logged'].''
        );

        $postear = new Postear($url,$data);
        $result = $postear->getPost();
        $response = json_decode($result,true);

        //Header
        
        echo '<div class="header">';
        echo '<h1>Bienvenido '. $response['name']. "</h1>";
        echo '
             <form action="..//lib/logout.php" method="post" class="form_cerrar">
             <input type="submit" name="btn_logout" value="cerrar sesion">
             </form>';
        echo '</div>';

        echo '<hr>';

        //Ultima marcacion
        $url = 'http://localhost/DESVII/proyectos/proy_03/api/marcacion/last.php';
        $data = array(
            'id_colaborador'=> $response['id_colaborador']
        );

        $postear = new Postear($url,$data);
        $result = $postear->getPost();
        $record = json_decode($result,true);

        echo '<div class="c_body" >';
        echo '<div class="c_registro" >';
        echo '<div class="div_1">';
        if(isset($record['records'])){
            $arg = $record['records'];
            $marcacion = $arg[0];
            echo 'Ultima marcacion: '.$marcacion['fecha']." ".$marcacion['hora'];
        }else{
            echo "Ultima marcacion: ". $record['message'];
        }
        echo '</div>';
        echo '<div class="div_2">';
        echo '
             <form action="..//lib/marcar.php" method="post">
             <input type="text" name="id_colaborador" id="" value = '.$response['id_colaborador'].' hidden >
             <input type="submit" name="btn_marcar" value="Marcar">
             </form>';

             echo '</div>';
        echo '</div>';
        echo '</div>';

        
    }else{
        print("Sesion no inciada, ir al <a href='../index.html'>Login</a>, para iniciar la sesion.");
    }




?>


  
</body>
</html>


