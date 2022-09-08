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
    if (array_key_exists('enviar', $_POST)){
        $Numero = $_REQUEST['Numero'];
        if($Numero != "")
        {
            if($Numero%2 == 0){
                echo "Tu numero es par. <br>";
                for($i=0; $i<$Numero; $i++){
                    for($j=0; $j<$Numero; $j++){
                        if($j==$i){
                            echo " | 1 | ";
                        }else{
                            echo " | 0 | ";
                        }
                    }

                    echo "<br>";  //Salto de lines
                }
            }else{
                echo "Favor de introducir numero par.";
            }
        }
    }else{
        ?> 

        <FORM ACTION = "p_05.php" METHOD = "POST">
            Introduzca un numero Par: <INPUT TYPE= "TEXT" NAME="Numero"><br>
            <INPUT TYPE = "SUBMIT" NAME= "enviar" VALUE= "Enviar datos">
        </FORM>

        <?php
    }
    
    ?>
    
</body>
</html>