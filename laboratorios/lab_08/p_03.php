<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laboratorio 4.3</title>
</head>
<body>
    <p>Laboratorio 8.3: Manejo de Arreglos P1</p>
    <?php 
    include('class_lib.php');

    $size_array = 20;

    $_arg01 = new Arreglo_p1($size_array);
   $_arg01->llenar_imprimir_arreglo();
   $_arg01->obtener_maximo();

    ?>

</body>
</html>