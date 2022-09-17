<?php 
//Laboratorio 7.5: Clonación de objetos

include("class_lib.php");

$obj = new MyCloneable();

$obj->object1 = new SubObject();
$obj->object2 = new SubObject();

$obj2 = clone $obj;

print("<br>Original Object: ");
print_r($obj);

print("<br>Cloned Objet: ");
print_r($obj2);

?>