<?php
//inicio de sesion
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcial 2</title>
</head>
<body>
    <h1> Parcial 2 </h1>
    <form name="formParcial2" action="index.php" method="post">
    Introduzca un numero: <input type="number" name="nvalor">
    <input type="submit" name="calcular" value="Calcular">
    </form>
    <br>
    
    <hr>

    <br>
</body>
</html>

<?php

    require_once('class/lib.php');
    require_once('class/historial.php');

    $obj_historial = new historial();

    if(array_key_exists('calcular',$_POST)){
        

        $nvalor = $_REQUEST['nvalor']; 
        if($nvalor > 0){

            $obj_lib = new lib();
            $rfactorial = $obj_lib->nFactorial($nvalor);
            $rsum  = 0;

            for ($i = 1; $i <= $nvalor; $i++) {

               $rsum += $obj_lib->nSumatoria($i);
            //    echo "<br> arriba: ". ($i - 1);
            //    echo " fac: ". $obj_lib->nFactorial($i);
            //    echo " sum:".$rsum;
            //    echo "<br>";
            }

            // echo "<br> rsum: ". $rsum;
            // echo "<br> rfactorial: ". $rfactorial;

           $obj_historial->insert($nvalor,$rfactorial,$rsum); 

        }else{
            echo "Favor de introducir un numero mayor a 0.";
        }
    }

    if(array_key_exists('editar',$_POST)){
        $id  = $_REQUEST['pid'];

        $nvalor = $_REQUEST['nvalue']; 
        if($nvalor > 0){

            $obj_lib = new lib();
            $rfactorial = $obj_lib->nFactorial($nvalor);
            $rsum  = 0;

            for ($i = 1; $i <= $nvalor; $i++) {

               $rsum += $obj_lib->nSumatoria($i);
            //    echo "<br> arriba: ". ($i - 1);
            //    echo " fac: ". $obj_lib->nFactorial($i);
            //    echo " sum:".$rsum;
            //    echo "<br>";
            }

            // echo "<br> rsum: ". $rsum;
            // echo "<br> rfactorial: ". $rfactorial;

           $obj_historial->update($id,$nvalor,$rfactorial,$rsum); 

        }else{
            echo "Favor de introducir un numero mayor a 0.";
        }

    }



   $historial =  $obj_historial->select();
   $nfilas = count($historial);

   if ($nfilas > 0){
    echo "
    <table>
    <tr>
        <th>id</th>
        <th>nvalor</th>
        <th>Factorial</th>
        <th>Sumatoria</th>
        <th></th>
    </tr>
    ";

    foreach ($historial as $resultado){
    echo"
    <tr>
        <form name='form_ed' method='post' action='index.php' >
        <td><input  type='text' name='pid' value='".$resultado['id']."'></td>
        <td><input  type='text' name='nvalue' value='".$resultado['nvalue']."'></td>
        <td><input disabled type='text' name='fa' value='".$resultado['factorial']."'></td>
        <td><input disabled type='text' name='sum' value='".$resultado['sumatoria']."'></td>
        <td>
            <input type='submit' value='Editar' name='editar' >
        </td>
        </form>
     </tr>
     ";
    }

     echo "
        </table>";


   }else{
    echo "<div class='mensaje'>No hay data aun, favor de agregar</div>";
   }




?>