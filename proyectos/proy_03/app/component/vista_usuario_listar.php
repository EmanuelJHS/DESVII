

<?php

include_once("..//lib/utility.php");


echo '
    <div>
    <form action="main_admin.php" method="post">
        <label for="">ID Colaborador:</label>
        <input type="text" name="id_colaborador" id="id_colaborador" >
        <input type="submit" name="btn_usuario_buscar" value="Buscar">
        <input type="submit" name="btn_usuario_agregar" value="Agregar">
    </form>    
    </div>
    ';




$url = 'http://localhost/DESVII/proyectos/proy_03/api/usuario/listar.php';
$data = array(); //No es necesario pasar el arreglo, puede ir en blanco;


if(array_key_exists('btn_usuario_buscar',$_POST) && !empty($_REQUEST['id_colaborador'])){
    $url = 'http://localhost/DESVII/proyectos/proy_03/api/usuario/select_1.php';
    $data = array(
        'id_colaborador'=>''.$_REQUEST['id_colaborador'].''
    ); 
}

$postear = new Postear($url,$data);
$result = $postear->getPost();
$response = json_decode($result,true);
if(isset($response['records'])){

    $registros =  $response['records'];
    $nfilas = count($registros);

    if ($nfilas > 0){
        echo '<div>';
        echo "<table>";
        echo '
            <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Rol</th>
            <th>Estado</th>
            <th></th>
            </tr>
        ';
    foreach ($registros as $resultado){
        echo "<tr>";
        echo '
        
        <form action="main_admin.php" method="post">
            <input hidden type="text" name="id_edit" id="" value="'.$resultado['id'].'">
            <input hidden type="text" name="id_edit_colaborador" value="'.$resultado['id_colaborador'].'">
            <td>'.$resultado['id_colaborador'].'</td>
            <td>'.$resultado['user'].'</td>
            <td>'.$resultado['name'].'</td>
            <td>'.$resultado['rol'].'</td>
            <td>'.$resultado['estado'].'</td>
            <td><input type="submit" value="Editar" name="btn_usuario_editar"></td>
        </form>
        </div>
        ';
        echo "</tr>";
    }

        echo "</table>";
        echo '</div>';


    // print ("</table>\n");
    }else{
    echo "<div class='mensaje'>No hay registros</div>";
    }

    // <input type="text" name="id_edit_colaborador" value="'.$resultado['id_colaborador'].'">
    // <input type="text" name="user" id="" value="'.$resultado['user'].'">
    // <input type="text" name="name" id="" value="'.$resultado['name'].'">
    // <input type="text" name="rol" id="" value="'.$resultado['rol'].'">
    // <input type="text" name="estado" id="" value="'.$resultado['estado'].'">




}else{
    echo "<div class='mensaje'>".$response['message']."</div>";
}








function plantilla(){
    echo '
    <div>
    <form action="" method="post">
        <input type="text" name="id" id="" value="">
        <input type="text" name="id_colaborador">
        <input type="text" name="user" id="">
        <input type="text" name="name" id="">
        <input type="text" name="rol" id="">
        <input type="text" name="estado" id="">
        <input type="submit" value="Editar" name="btn_usuario_editar">
    </form>
    </div>
    ';
}


?>




