<?php

    include_once("utility.php");

        session_start();
        session_destroy();
        $pagina = new PaginaController();
        $pagina->cambiar("http://localhost/DESVII/proyectos/proy_03/app/index.html");
    
?>