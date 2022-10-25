

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="jquery.dataTables.min.css">
    <script src="jquery-3.1.1.js"></script>
    <script src="jquery.dataTables.min.js"></script>
    <title>Ejemplo DataTable JQuery</title>
</head>
<body>
    <script>
        $(document).ready(function(){
            $("#grid").DataTable({
                "lengthMenu":[5,10,20,50],
                "lenguage":{
                    "lengthMenu":"Mostar _Menu_ registrar por paginas",
                    "zeroRecords":"No existe resultados en su busqueda",
                    "info":"Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(Buscado entre _MAX_ registro en total)",
                    "search":"Buscar: ",
                    "paginate: ": {
                        "first":"Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                }
            });
            $("*").css("font-family","arial").css("font-size","12px");
        })
    </script>
    <h1>Consulta de la noticias</h1>
<?php
    require_once("class/noticias.php");

    $obj_noticia = new noticia();
    $noticias = $obj_noticia->consultar_noticias();

    $nfilas = count($noticias);

    if ($nfilas > 0){
        print ("<table id='grid' class='display' cellspacin='0'>\n");
        print ("<thead>");
        print ("<tr>\n");
        print ("<th>Titulo</th>\n");
        print ("<th>Texto</th>\n");
        print ("<th>Categoria</th>\n");
        print ("<th>Fecha</th>\n");
        print ("<th>Imagen</th>\n");
        print ("</tr>\n");
        print ("</thead>");
        print ("<tbody>");


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
        print ("</tbody>");
        print ("</table>\n");
    }else{
        print("No hay noticias disponibles");
    }


?>
</body>
</html>

