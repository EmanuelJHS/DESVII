<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laboratorio 4.5</title>
</head>
<body>

<?php 
$matriz = array();
$sumatoria = 0;
$multi = 1;


function imprimirMatriz($arg, $num){

    for($i=0; $i<$num; $i++){
        for($j=0; $j<$num; $j++){
            echo "| ";
           echo $arg[$i][$j];
           echo " |";
        }
        echo "<br>";
    }


}

    if (array_key_exists('enviar', $_POST)){
        $Numero = $_REQUEST['Numero'];
        $contador = $Numero;
        if($Numero != "")
        {
            if($Numero%2 == 0){
                echo "Tu numero es par. <br>";
                for($i=0; $i<$Numero; $i++){
                    for($j=0; $j<$Numero; $j++){
                       $matriz[$i][$j] = "0";
                    }
                    $n_aleatorio = rand(101,200);
                    $matriz[$i][--$contador] = $n_aleatorio; //Momento donde se le descuenta 1 al contador. --$contador.

                    $sumatoria += $matriz[$i][$contador];
                    $multi *= $matriz[$i][$contador];
                }

                imprimirMatriz($matriz, $Numero); //Imprimiendo matriz
                echo "<br>";
                echo "La sumatoria de los numeros es: $sumatoria";
                echo "<br>";
                echo "La multiplicacion de los numeros es: $multi";
            }else{
                echo "Favor de introducir numero par.";
            }
        }
    }else{
        ?> 

        <FORM ACTION = "p_01.php" METHOD = "POST">
            Introduzca un numero Par: <INPUT TYPE= "TEXT" NAME="Numero"><br>
            <INPUT TYPE = "SUBMIT" NAME= "enviar" VALUE= "Enviar datos">
        </FORM>

        <?php
    }
    
    ?>
    
</body>
</html>