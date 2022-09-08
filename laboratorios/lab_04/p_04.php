<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laboratorio 4.4</title>
</head>
<body>
<p>Laboratorio 4.4: Manejo de Arreglos P2</p>

<?php 
    if (array_key_exists('enviar', $_POST)){
        $Numero = $_REQUEST['Numero'];
        if($Numero != "")
        {
            if($Numero%2 == 0){
                echo "Tu numero es par. <br>";

            }else{
                echo "Favor de introducir numero par.";
            }
        }
    }else{
        ?> 

        <FORM ACTION = "p_04.php" METHOD = "POST">
            Introduzca un numero Par: <INPUT TYPE= "TEXT" NAME="Numero"><br>
            <INPUT TYPE = "SUBMIT" NAME= "enviar" VALUE= "Enviar datos">
        </FORM>

        <?php
    }
    
    ?>
    
</body>
</html>