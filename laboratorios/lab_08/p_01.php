<?php 
include('class_lib.php');

$calificacion =$_POST['calificacion'];

$cla = new Clasificador($calificacion);
$cla->obtener_calificacion();

echo "<br/> <br/>";
echo "Agradecemos su evaluacion!"
?>

