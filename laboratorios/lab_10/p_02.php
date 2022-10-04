<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Laboratorio 10.2</title>
</head>
<body>
    <H1>Encuesta. Resultado de la votacion</H1>

    <?php
        require_once("class/votos.php");

        $obj_votos = new votos();
        $result_votos = $obj_votos->listar_votos();

        foreach($result_votos as $result_voto){
            $votos1=$result_voto['votos1'];
            $votos2=$result_voto['votos2'];
        }

        $totalVotos = $votos1 + $votos2;

        print ("<TABLE>\n");

        print ("<tr>\n");
        print ("<th>Respuesta</th>\n");
        print ("<th>Votos</th>\n");
        print ("<th>Porcentaje</th>\n");
        print ("<th>Respuesta grafica</th>\n");
        print ("</tr>\n");

        $porcentaje = round (($votos1/$totalVotos)*100,2);
        print ("<tr>\n");
        print ("<td class='izquierda'>Si</td>\n");
        print ("<td class='derecha'>$votos1</td>\n");
        print ("<td class='derecha'>$porcentaje</td>\n");
        print ("<TD class='izquierda' width='400'><img src='img/puntoamarillo.gif' height='10' width='".($porcentaje*4)."'></TD>\n");
        print ("</tr>\n");

        $porcentaje = round (($votos2/$totalVotos)*100,2);
        print ("<tr>\n");
        print ("<td class='izquierda'>No</td>\n");
        print ("<td class='derecha'>$votos2</td>\n");
        print ("<td class='derecha'>$porcentaje</td>\n");
        print ("<td class='izquierda' width='400'><img src='img/puntoamarillo.gif' height='10' width='".($porcentaje*4)."'></td>\n");
        print ("</tr>\n");

        print ("</table>\n");
        print ("<P>Numero total de votos emitidos: $totalVotos </P>\n");
        print ("<P><A HREF='p_01.php'>Pagina de votacion</A></P>\n");
        
    ?>

    
</body>
</html>