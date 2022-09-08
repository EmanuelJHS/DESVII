

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
           
<FORM ACTION = "p_04.php" METHOD = "POST">
            Introduzca un numero Par: <INPUT TYPE= "TEXT" NAME="Numero"><br>
            <INPUT TYPE = "SUBMIT" NAME= "enviar" VALUE= "Enviar datos">
            
        </FORM>

        


<?php

//variables
  $_arg = array();

  function limpiar(){
        $file = fopen("./_src/p_04.txt", "w"); //escribe desde la primera linea
        fwrite($file, "");
        fclose($file);

  };

function escritura($texto){
    //$file = fopen("./_src/p_04.txt", "w"); //escribe desde la primera linea
    $file = fopen("./_src/p_04.txt", "a"); //escribe desde la ultima linea
    fwrite($file, "".$texto.PHP_EOL);
    fclose($file);

};


function lectura(){
    $file = fopen("./_src/p_04.txt","r");
    $arreglo = array(); 
    $contador = 0;

         while(!feof($file)){
        //echo fgets($file). "<br/>";
        $texto = fgets($file);
        $arreglo[$contador] = $texto; 
        $contador += 1;
        //echo "contador: ". $contador." valor: ". $texto. "<br>";

    }
    fclose($file); 
    array_pop($arreglo); //Eliminar el ultimo elemento del arreglo.

   return $arreglo;

};

    $_arg = lectura();
    // echo "Tamano de _arg: ". sizeof($_arg)."<br>";

    if (array_key_exists('enviar', $_POST)){
        $Numero = $_REQUEST['Numero'];
        if($Numero != "")
        {
            if($Numero%2 == 0){
                echo "Tu numero es par. <br>";
                
                echo "<br/>";
                escritura($Numero);

                for ($i=0; $i<sizeof($_arg); $i++ ){
                    echo "<br>Posicion: ". $i. "| Valor: ". $_arg[$i];
                }

                
            }else{
                echo "Favor de introducir numero par.";
            }
        }

        lectura(); 

    }else{
        ?>      
        <?php
    }
    
    ?> 

</body>
</html> 