<?php session_start() ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Laboratorio 9.2</title>
</head>
<body>
    <h1>Consulta de la noticias</h1>
    <form name="FormFiltro" METHOD="post" ACTION="p_02.php">
        </br>
        Filtrar por: <Select name="campos">
            <option value="texto" SELECTED>Descripcion
            <option value="titulo">Titulo
            <option value="categoria">Categoria
        </Select>
        Con el valor
        <input type="text" NAME="valor">
        <input name="ConsultarFiltro" value="Filtro Datos" TYPE="submit"/>
        <input name="ConsultarTodos" value="Ver todos" TYPE="submit"/>

    </form>
<?php

//sesion iniciada
if(isset($_SESSION['usuario_valido'])){
    
    require_once("class/noticias.php");

   $obj_noticia = new noticia();
   $noticias = $obj_noticia->consultar_noticias();

    //Adicionando codigo 
    if(array_key_exists('ConsultarTodos', $_POST)){
        $obj_noticia = new noticia();
        $noticias = $obj_noticia->consultar_noticias();
    }

    if(array_key_exists('ConsultarFiltro', $_POST)){
        $obj_noticia = new noticia();
        $noticias = $obj_noticia->consultar_noticias_filtro($_REQUEST['campos'],$_REQUEST['valor']);
    }

    $nfilas = count($noticias);

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

