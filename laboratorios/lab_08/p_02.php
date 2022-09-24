<?php 
include('class_lib.php');
$numero = $_POST['numero'];

$fac = new Factorial($numero);
echo $fac->obtener_factorial();


?>