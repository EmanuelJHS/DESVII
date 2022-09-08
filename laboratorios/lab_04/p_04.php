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

    //Creando el arreglo
    $_arg = array('');

    function imprimirArreglo($arreglo){
        for ($i=0; $i < sizeOf($arreglo); $i++){
            echo "| ". $i. " | ". $arreglo[$i]. " | ";
        }
    }

   // do {

    if(array_key_exists('enviar', $_POST)){  
        $numero = $_REQUEST['Numero'];
        if($numero != ""){
            if($numero%2 == 0){
                array_push($_arg,$numero);
                imprimirArreglo($_arg);

            }else{
                echo "<alert> Por favor, introducir un numero par.";
            }
        }
    }else{
        ?>
        <form action="#" method="post">
            Introducir numero par: <input type="text" name="Numero">
        <input type="submit" varlue="enviar">
        </form>
        
        <?php 
        
        imprimirArreglo($_arg);
    }

    //}while( sizeof($_arg) < 20);


    ?>
</body>
</html>