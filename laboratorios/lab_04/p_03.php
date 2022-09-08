<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laboratorio 4.3</title>
</head>
<body>
    <p>Laboratorio 4.3: Manejo de Arreglos P1</p>
    <?php 

    function seRepite($valor, $arreglo){
        $resultado = FALSE;

         for($i=0; $i < sizeof($arreglo)-1; $i++ ){

            if($valor == $arreglo[$i]){
               // echo "f - Posiccion: " . $i." Valor: ". $valor. " | ". $arreglo[$i]. "<br>";
                $resultado = TRUE;
                return $resultado;
            }
         }

        return $resultado;
    }

   function buscarPosicion($valor, $arreglo){
    for($i=0; $i < sizeof($arreglo); $i++){

        if ($valor == $arreglo[$i]){
            return $i;
        }

        }
    }


    //Definir el arreglo
    $_arg = array('');
    //LLenando el arreglo
    for ($i=0; $i<20; $i++){
        //Asegurando que no se repitan los numeros.
        do {
            $_arg[$i]= rand(0,100) + rand(1,50);

            $aux = seRepite($_arg[$i],$_arg);
            
        }while( $aux > 0 );

        echo "Posicion: ". ($i + 1) ." | Valor: " . $_arg[$i] . " | ". $aux."<br>";
    }

    echo "<br><br.";
    $valorMaximo = max($_arg);
    echo " ". $valorMaximo . " <br/>";
    echo "Valor maximo: ". $valorMaximo.", en la posicion: ". ( buscarPosicion($valorMaximo, $_arg) + 1) . " <br/>";

    ?>

</body>
</html>