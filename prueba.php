<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas PHP</title>
</head>
<body>
<form  name="formPrueba" action="prueba.php" method="post">
Entrada:
<input type="text" name="a" id="a">
<input type="submit" name="enviar" value="enviar">
</form>
<?php 


$var = "I";

echo "Primera impresion: ".$var;


    if(array_key_exists('enviar',$_POST)){
        $GLOBALS['var'] = $_REQUEST['a'];
    }

echo"<br>";

echo "Segunda impresion: ". $var;



?>

</body>
</html>


