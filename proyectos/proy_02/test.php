
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>
<form action="test.php" name="formResumen" method="POST" id="fResumen">
        
        <input type="date" name="dateIn" id= "pickerDate" onchange="enviarDatos()">
        <input type="submit" name="btn_agregar" value="Agregar">
        <input type="submit" name="btn_reporte" value="Reporte">
    </form>

    <hr>
    <form action="test.php" name="formResumen" method="POST" id="fResumen">
        Nombre:<input type="text" name="nombre"><br>
        precio:<input type="text" name="precio"><br>
        descripcion:<input type="text" name="descripcion"><br>
        categoria_id:<input type="number" name="categoria_id"><br>
        <input type="submit" value="Enviar" name='enviar'>
        
    </form>

    <script src="js/resumen.js"></script>
</body>
</html>


<?php

if(array_key_exists('enviar',$_POST)){

    $data = array(
        'nombre'=>''.$_REQUEST['nombre'].'',
        'precio'=>''.$_REQUEST['precio'].'',
        'descripcion'=>''.$_REQUEST['descripcion'].'',
        'categoria_id'=>''.$_REQUEST['categoria_id'].''
    );

    

    $post_Data = json_encode($data);

    $ch = curl_init();

    $options = array(
        CURLOPT_URL => 'http://localhost/api/producto/crear.php',
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $post_Data,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_HTTPHEADER => array('Content-Type: application/json')
    );

    curl_setopt_array($ch,$options);
    $result = curl_exec($ch);
    curl_close($ch);
    print_r($result);
}
    

// }


// if(array_key_exists('dateIn',$_POST)){

//     $data = array(
//         'dateIn'=>''.$_REQUEST['dateIn'].''

//     );
//     $post_Data = json_encode($data);
//     $ch = curl_init();
//     $options = array(
//         CURLOPT_URL => 'http://localhost/DESVII/proyectos/proy_02/api/actividad/leer.php',
//         CURLOPT_POST => 1,
//         CURLOPT_POSTFIELDS => $post_Data,
//         CURLOPT_RETURNTRANSFER => 1,
//         CURLOPT_HTTPHEADER => array('Content-Type: application/json')
//     );

//     curl_setopt_array($ch,$options);
//     $result = curl_exec($ch);
//     curl_close($ch);
//     print_r($result);
//     //echo "<hr>";

//     $response = json_decode($result,true);
//     echo "<hr>";
//     echo var_dump($response['records']);
//     foreach ($response['records']  as $d) {

//         echo "<hr>";
//         echo "*-*-*-*-*-Id: ". $d['id'];

//         foreach($d as $nombre => $valor){

        
//             if(!is_array($valor)){
//                 print "Campo $nombre : valor $valor <br>";
//             }else{
//                 print "campo $nombre : [";
//                 foreach($valor as $valor_array){
//                     if(!is_array($valor_array))
//                         print "Valor: $valor_array, ";
//                     else 
//                         print "<arreglo>";
//                 }
//                 print "]<br>";
//             }
//         }

//     }

// }

// $id = 11;

// $data = json_decode(file_get_contents('http://localhost/DESVII/proyectos/proy_02/api/actividad/leer_uno.php?id='.$id.''),true);
// var_dump($data);

// foreach($data as $nombre => $valor){
//     if(!is_array($valor)){
//         print "Campo $nombre : valor $valor <br>";
//     // }else{
//     //     print "campo $nombre : [";
//     //     foreach($valor as $valor_array){
//     //         if(!is_array($valor_array))
//     //             print "Valor: $valor_array, ";
//     //         else 
//     //             print "<arreglo>";
//     //     }
//     //     print "]<br>";
//     }
// }
// echo "<br>";
// echo "Impresion: ". $data['titulo'];

//******Para Eliminar */

// $id = 38 ;
// $data = json_decode(file_get_contents('http://localhost/DESVII/proyectos/proy_02/api/actividad/eliminar.php?id='.$id.''),true);

// echo "<br> codigo de respuesta: ".http_response_code();
// echo "<br>";
// var_dump($data);
// if(is_null($data)){

// }else{
//     foreach($data as $nombre => $valor){
//         if(!is_array($valor)){
//             print "Campo $nombre : valor $valor <br>";
//         }else{
//             print "campo $nombre : [";
//             foreach($valor as $valor_array){
//                 if(!is_array($valor_array))
//                     print "Valor: $valor_array, ";
//                 else 
//                     print "<arreglo>";
//             }
//             print "]<br>";
//         }
//     }

// }



?>