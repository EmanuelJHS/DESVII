<?php
    session_start();

    if(isset($_REQUEST['usuario']) && isset($_REQUEST['clave'])){

        $usuario = $_REQUEST['usuario'];
        $clave = $_REQUEST['clave'];

        $salt= substr($usuario,0,2);
        $clave_crypt = crypt ($clave,$salt);

        require_once("class/usuarios.php");

        $obj_usuarios = new usuarios();
        $usuario_validado = $obj_usuarios->validar_usuario($usuario,$clave_crypt);

        foreach($usuario_validado as $array_resp){
            foreach($array_resp as $value){
                $nfilas = $value;
            }
        }

        if($nfilas > 0){
            $usuario_valido = $usuario;
            $_SESSION['usuario_valido'] = $usuario_valido;
        }


    }

?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/estilo.css">
        <title>Laboratorio 14</title>
    </head>
    <body>
        <?php
            //sesion iniciada
            if(isset($_SESSION['usuario_valido'])){

                ?>
                <H1>Gestion de noticias</H1>
                <hr>
                <ul>
                    <li><a href="p_01.php">Listar todas las noticias</a></li>
                    <li><a href="p_03.php">Listar noticias por parte</a></li>
                    <li><a href="p_04.php">Buscar noticia</a></li>
                </ul>

                <hr>
                <p><a href="logout.php">Desconectar</a></p>

                <?php
            }else if(isset($usuario)){
                //Intento de entrada fallido
                print("<br><br>\n");
                print("<p align='CENTER'>Acceso no autorizado</p>\n");
                print("<p align='CENTER'>[<a href='login.php'>Conectar</a>]</p>\n");
            }else{
                //Sesion no iniciada
                print("<br><br>\n");
                print("<p class='parrafocentrado'>Esta zona tiene el acceso restringido<br>
                Para entrar debe identificarse</p>\n");
                print("
                <form class='entrada' name='login' method='post' action='login.php'>\n
                <p><label for='' class='etiqueta-entrada'>Usuario:</label>\n
                <input type='text' name='usuario' size='15'></p>\n
                <p><label for='' class='etiqueta-entrada'>Clave:</label>\n
                <input type='text' name='clave' id='' size='15'></p>\n
                <p><input type='submit' value='entra'></p>\n
                </form>\n
                <p class='parrafocentrado'>NOTA: si no dispone de identicacion o tiene problemas
                para entrar<br>Pongase en contacto con el <a href='mailto:webmaster@localhost'>administrador</a> del sitio</p>\n");
            }
        ?>

    </body>
    </html>