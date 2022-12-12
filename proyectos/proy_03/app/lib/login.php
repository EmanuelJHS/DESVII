<?php

    include_once("utility.php");



        if(array_key_exists("btn_login",$_POST)){

        $user = $_REQUEST['user'];
        $pass = $_REQUEST['pass'];

        $data = array(
            'user'=>''.$user.'',
            'pass'=>''.$pass.''
        );
        
        $url = 'http://localhost/DESVII/proyectos/proy_03/api/usuario/login.php';
        $postear = new Postear($url,$data);
        $result = $postear->getPost();
        $response = json_decode($result,true);
        // var_dump($response);
        
        
        if(count($response)>1){
           // var_dump($response); //ver que trae
           if($response['estado']=='a'){
            session_start();
            $_SESSION['id_logged'] = $response['id'];
            $_SESSION['id_colaborador_logged'] = $response['id_colaborador'];
            $_SESSION['user_logged'] = $response['user'];
            $_SESSION['pass_logged'] = $response['pass'];

            //Iniciar sesion y dirigirnos a la pagina principal de acuerdo al rol que tengamos
            $direccion='';
            switch($response['rol']){
                case 'ad':
                    $direccion = 'http://localhost/DESVII/proyectos/proy_03/app/view/main_admin.php';
                    break;
                case 'sp':
                    $direccion = 'http://localhost/DESVII/proyectos/proy_03/app/view/main_admin.php';
                    break;
                case 'co':
                    $direccion = 'http://localhost/DESVII/proyectos/proy_03/app/view/main_co.php';
                    break;
            }

            $pagina = new PaginaController();
            $pagina->cambiar($direccion);

            }else{          
                $pagina = new PaginaController();
                $pagina->alerta('Usuario no valido');
                $pagina->cambiar("http://localhost/DESVII/proyectos/proy_03/app/index.html");
            }


        }else{
            //no existe, rederigir a la pagina de login, que valide el usuario
            //y mandar mensaje
            
            $pagina = new PaginaController();
            $pagina->alerta($response['message']);
            $pagina->cambiar("http://localhost/DESVII/proyectos/proy_03/app/index.html");
 

        }

        //  echo "<br> Prueba usuario: " ;

        

        




    }


?>
