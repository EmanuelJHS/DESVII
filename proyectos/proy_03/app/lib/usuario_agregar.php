<?php

include_once("utility.php");


if(array_key_exists('btn_agregar_usuario',$_POST)){

    $url = 'http://localhost/DESVII/proyectos/proy_03/api/usuario/agregar.php';
        $data = array(
            'id_colaborador'=>''.$_REQUEST['id_colaborador'].'',
            'user'=>''.$_REQUEST['user'].'',
            'pass'=>''.$_REQUEST['pass'].'',
            'name'=>''.$_REQUEST['name'].'',
            'rol'=>''.$_REQUEST['rol'].'',
            'estado'=>''.$_REQUEST['estado'].''

        );

        $postear = new Postear($url,$data);
        $result = $postear->getPost();
        $response = json_decode($result,true);

        $pagina = new PaginaController();
        $pagina->alerta($response['message']);
        $pagina->cambiar("http://localhost/DESVII/proyectos/proy_03/app/view/main_admin.php");


}


?>