<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Laboratorio 11</title>
</head>
<body>
    <h1>Consulta de la noticias</h1>

<?php
                //sesion iniciada
                if(isset($_SESSION['usuario_valido'])){

    require_once("class/noticias.php");

    $obj_noticia = new noticia();
    $noticias = $obj_noticia->consultar_noticias();
    //total de filas
    $totalfilas = count($noticias); 
    $nfilas=0;
    $p_min = 0; //Primera fila

    //Botones
    $btn_anterior = "";
    $btn_siguiente = "";

    //Funciones
    //Parametros: el limite, iniciar desde
    function listarLimit($n){
        $obj_noticia = new noticia();
        $noticias = $obj_noticia->consultar_noticias_limit($n);
        return $noticias;
    }

    $noticias = listarLimit($p_min);
    $nfilas = count($noticias);
    $p_max = $p_min+ count($noticias); //Ultima fila

     function actualizarBotones(){
        if($GLOBALS['p_min']<=1){
            $GLOBALS['btn_anterior'] = '<input name="anterior" value="Anterior" TYPE="submit" disabled="true"/> |';
        }else{
            $GLOBALS['btn_anterior'] = '<input name="anterior" value="Anterior" TYPE="submit" /> |';
        }

        if($GLOBALS['p_max'] >= $GLOBALS['totalfilas']){
            $GLOBALS['btn_siguiente'] = ' <input name="siguiente" value="Siguiente" TYPE="submit" disabled="true"/> ]';
        }else{
            $GLOBALS['btn_siguiente'] = ' <input name="siguiente" value="Siguiente" TYPE="submit" /> ]';
        }
    }

    if(array_key_exists('siguiente', $_POST)){

      $GLOBALS['p_min'] = $GLOBALS['p_max'];
      $GLOBALS['noticias'] = listarLimit( $GLOBALS['p_max']);
      $GLOBALS['p_max'] = $GLOBALS['p_min']  + count($GLOBALS['noticias']);

     }
 
    if(array_key_exists('anterior', $_POST)){



    }
    

    //Imprimiendo paginacion
    $mensaje = "Mostrando noticas ".($p_min+1)." a ".$p_max." de un total de ".$totalfilas.". [ ";
    //Mensaje: Mostrando noticia 1 al 5 de un total de 7.[ Anterior | Siguiente ]
    echo ' <form name="FormPaginacion" METHOD="post" ACTION="p_01.php">';
    echo $mensaje;
   actualizarBotones(); //Actualizando los botones, cuando se carga la pagina
    echo $btn_anterior;
    echo $btn_siguiente;
    echo '
        <input name="n_min" value="'.$p_min.'" TYPE="text" hidden="true" />
        </form>
        <br><br>';

        //hidden="true"


    //Imprime la tabla
    if ($nfilas > 0){
        print ("<table>\n");
        print ("<tr>\n");
        print ("<th>Titulo</th>\n");
        print ("<th>Texto</th>\n");
        print ("<th>Categoria</th>\n");
        print ("<th>Fecha</th>\n");
        print ("<th>Imagen</th>\n");
        print ("</tr>\n");

        foreach ($noticias as $resultado){
            print ("<tr>\n");
            print ("<td>".$resultado['titulo']."</td>\n");
            print ("<td>".$resultado['texto']."</td>\n");
            print ("<td>".$resultado['categoria']."</td>\n");
            print ("<td>".date("j/n/Y",strtotime($resultado['fecha']))."</td>\n");

            if ($resultado['imagen'] != ""){
                print ("<td><a target='_blank' href='img/".$resultado['imagen']."'><img border='0' src='img/iconotexto.gif'></a></td>\n");
            }else{
                print ("<td>&nbsp;</td>\n");
            }
            print ("</tr>\n");
        }
        print ("</table>\n");
    }else{
        print("No hay noticias disponibles");
    }

    print("<p>[ <a href='login.php'>Menu principal</a> ]</p>");

}else{
    print("<br><br>");
    print("<p align='CENTER'>Acceso no autorizado</p>\n");
    print("<p align='CENTER'>[ <a href='login.php' target='_top'>Conectar</a> ]</p>\n");
}


?>
</body>
</html>

