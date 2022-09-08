<?php 
$numero = $_POST['numero'];

if($numero > 0)
{
    $resultado = 1;
    for ($i=$numero; $i > 0; $i--){
     $resultado = $resultado * $i;
    }
    echo "Resultado: ". $resultado;
}else{
    echo "Favor de introducir un numero mayor a 0.";
}

?>