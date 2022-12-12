
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
    <link rel="stylesheet" href="../css/main_admin.css">
    <title>Document</title>
</head>
<body>

<?php

    // mostar nombre del usuario
    // boton para cerrar sesion y mandar al login
    // si no esta logged, mandar al login 

    if(isset($_SESSION['user_logged'])){

    $url = 'http://localhost/DESVII/proyectos/proy_03/api/usuario/login.php';
    $data = array(
        'user'=>''.$_SESSION['user_logged'].'',
        'pass'=>''.$_SESSION['pass_logged'].''
    );

    $postear = new Postear($url,$data);
    $result = $postear->getPost();
    $response = json_decode($result,true);

    echo '<div class="header">';
    echo '<h1>Bienvenido '. $response['name']."</h1>";
    echo '
         <form action="..//lib/logout.php" method="post" class="form_cerrar">
         <input type="submit" name="btn_logout" value="cerrar sesion">
         </form>';

    echo '</div>';

    echo '<hr>';

    echo '<div class="c_body">';
    echo '
    <div class="barra_lateral">
    <form action="main_admin.php" method="post">
        <input type="text" name="ventana" value="usuarios" id="" hidden>
        <input type="submit" value="Usuario" name="btn_usuarios">
    </form>
    <form action="main_admin.php" method="post">
        <input type="text" name="ventana" value="equipos" id="" hidden>
        <input type="submit" value="Equipos" name="btn_equipos">
    </form>
    <form action="main_admin.php" method="post">
        <input type="text" name="ventana" value="reporte" id="" hidden>
        <input type="submit" value="Reporte" name="btn_reporte">
    </form>
    </div>
    ';

     echo '<div class="ventana">';
     
    $ventana = 'usuarios';
    if(isset($_REQUEST['ventana'])){$ventana = $_REQUEST['ventana'];}
    echo '<div class="ventana_titulo">'.$ventana.'</div>';
    switch ($ventana) {
        case 'usuarios':
            if(array_key_exists('btn_usuario_editar',$_POST)){
                include('../component/vista_usuario_editar.php');
                $vista_editar = new VistaUsuarioEditar();
                $vista_editar->editar($_REQUEST['id_edit_colaborador']);
            }elseif(array_key_exists('btn_usuario_agregar',$_POST)){
                include('..//component/vista_usuario_agregar.php');
            }else{
                include('..//component/vista_usuario_listar.php');
                
            }
            break;
        
        case 'equipos':
                # code...
            break;
        
        case 'reporte':
            include('..//component/vista_reporte.php');
            $vista_reporte = new VistaReporte();
            $vista_reporte->plantilla();

            if(array_key_exists('btn_buscar_reporte',$_POST)){
                $vista_reporte->imprimirRegistros(
                    $vista_reporte->buscarData(
                        $_REQUEST['id_colaborador'],
                        $_REQUEST['fechaIn'],
                        $_REQUEST['fechaOut']
                    )
                );

                $vista_reporte->ultimaBusqueda(
                    $_REQUEST['id_colaborador'],
                    $_REQUEST['fechaIn'],
                    $_REQUEST['fechaOut']
                );

             }
            
            break;
        
        default:
            # code...
            break;
    }
    echo '</div>';//class ventana

    echo '</div>';//class c_body



    }else{
        print("Sesion no inciada, ir al <a href='../index.html'>Login</a>, para iniciar la sesion.");
    }




?>





  
</body>
</html>


