<?php

    class Postear{
        //necesito 1. array
        //2. url
        //regresar una respuesta.
        private $url;
        private $arg;


        function __construct( $url,$arg ){
            $this->url=$url;
            $this->arg=$arg;
        }


        function getPost(){
            try{
                $data = $this->arg;
                $post_Data = json_encode($data);
                $ch = curl_init();
                $options = array(
                    // CURLOPT_URL => 'http://localhost/DESVII/proyectos/proy_02/api/actividad/leer.php',
                    CURLOPT_URL => $this->url,
                    CURLOPT_POST => 1,
                    CURLOPT_POSTFIELDS => $post_Data,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_HTTPHEADER => array('Content-Type: application/json')
                );
            
                curl_setopt_array($ch,$options);
                $result = curl_exec($ch);
                curl_close($ch);
    
                return $result;

            }catch (Exception $e) {
                echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            }

        }

    }

    class PaginaController{

        function cambiar($direccion){
            // window.location.replace("http://nuevapagina.php/");  //Otra forma de hacerlo
            ?>
            <script>
            window.location.href= <?php echo "'".$direccion."'" ?>;
            </script>
            <?php


        }

        function alerta($message){
            ?>
            <script>
            window.alert( <?php echo "'".$message."'" ?>   );
            </script>
            <?php

        }


        function selectedIndex($obj,$index){
            ?>
            <script>
                let <?php echo "_".$obj ?> = document.getElementById(<?php echo "'".$obj."'" ?>);
                <?php echo "_".$obj ?>.selectedIndex = <?php echo "'".$index."'" ?> ;
            </script>
            <?php
        }

        function setValue($obj,$value){
            ?>
            <script>
                let <?php echo "_".$obj ?> = document.getElementById(<?php echo "'".$obj."'" ?>);
                <?php echo "_".$obj ?>.value = <?php echo "'".$value."'" ?> ;
            </script>
            <?php
        }



    }

    class Tablas{

        function EstadoIndex($s){
            $result = "";
            switch ($s) {
                case 'Activo':
                    $result = 0;
                    break;

                case 'Inactivo':
                    $result = 1;
                    break;
                
                default:
                    # code...
                    break;
            }
            return $result;
        }


        function RolIndex($s){
            $result = "";
            switch ($s) {
                case 'Adimistrador':
                    $result = 0;
                    break;
                case 'Colaborador':
                    $result = 1;
                    break;

                case 'Supervisor':
                    $result = 2;
                        break;
                
                default:
                    # code...
                    break;
            }
            return $result;
        }
    }


?>