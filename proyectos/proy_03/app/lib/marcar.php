<?php
    include_once("utility.php");


    if(array_key_exists('btn_marcar',$_POST)){

        date_default_timezone_set('America/Panama'); //Se estable la zona horario
        $DateAndTime = date('Y-m-d H:i:s ', time()); //Se obtiene la fecha
        $fecha = substr($DateAndTime,0,10);
        $hora = substr($DateAndTime,11,10);

        $url = 'http://localhost/DESVII/proyectos/proy_03/api/marcacion/agregar.php';
        $data = array(
            'id_colaborador'=>''.$_REQUEST['id_colaborador'].'',
            'fecha'=>''.$fecha.'',
            'hora'=>''.$hora.''
        );

        $postear = new Postear($url,$data);
        $result = $postear->getPost();
        $response = json_decode($result,true);

        $pagina = new PaginaController();
        $pagina->alerta($response['message']);
        $pagina->cambiar("http://localhost/DESVII/proyectos/proy_03/app/view/main_co.php");

    }

?>