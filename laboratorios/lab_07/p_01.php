<?php 
//Laboratorio 7.1: Creación y uso de constantes en una clase


include("class_lib.php");

//Accediento diramente a la constante
echo MiClase::constante."<br>";

//Accediendo mediente una funcion.
$clase = new MiClase();
$clase->mostrarConstante();


?>