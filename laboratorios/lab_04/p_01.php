<?php 
$calificacion =$_POST['calificacion'];

if($calificacion > 79){
    $image = "./_img/good.jpg";
    echo '<img src="' . $image . '"/>';
}elseif($calificacion > 49){
    $image = "./_img/normal.jpg";
    echo '<img src="' . $image . '"/>';
}else{
    $image = "./_img/bad.jpg";
    echo '<img src="' . $image . '"/>';
}

echo "<br/> <br/>";
echo "Agradecemos su evaluacion!"
?>

