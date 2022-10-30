<?php
require_once("validar.php");

    $obj_validar = new Validar();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio 18</title>
</head>
<body>
    <form action="index.php" method="POST" name="formRegex">
        Nombre: <input type="text" name="nombre" id="" required>
        <br>
        Apellido: <input type="text" name="apellido" id="" required>
        <br>

            <?php 

             ?>

        Email: <input type="email" name="mail" id="" pattern="/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/" required>
            <?php 
                if(array_key_exists('registrar',$_POST)){

                $obj_validar->setMail($obj_validar->verificar_email($_REQUEST['mail']));
                if($obj_validar->verificar_email($_REQUEST['mail'])){
                    echo "Direccion de correo valida.";
                }else{
                    echo "Direccion de correo no es valida.";
                };
                }

             ?>
        <br>
        Contrasena: <input type="password" name="psw" id="" required>
            <?php 
                if(array_key_exists('registrar',$_POST)){
                    $obj_validar->setPsw(
                       $obj_validar->verificar_password_strenght($_REQUEST['psw'])
                    );
                }
             ?>
        <br>
        Repetir Contrasena: <input type="password" name="psw_r" id="" required>            
            <?php
             if(array_key_exists('registrar',$_POST)){           
               $obj_validar->setPsw_r(
                     $obj_validar->verificar_password_strenght($_REQUEST['psw_r'])
               );

             }

             ?>
        <br>
        IP Actual del equipo: <input type="text" name="ip" id="" required>
            <?php          
            if(array_key_exists('registrar',$_POST)){      
                $obj_validar->setIp($obj_validar->verificar_ip($_REQUEST['ip']));
               if($obj_validar->verificar_ip($_REQUEST['ip'])){
                echo "IP valida.";
               }else{
                echo "IP no es valida.";
               };
            }

             ?>
        <br>
        <input type="submit" value="Registrar usuario" name="registrar">
    </form>

    <?php

    if(array_key_exists('registrar',$_POST)){    
        if($obj_validar->registrar_usuario()){
            ?>
                <script>
                    alert("Se ha registrado de forma correcta.")
                </script>
            <?php
        }else{
            echo 'No se ha podido registrar, Vuelva a intentarlo mas tarde';
        }
    }
                
    ?>
    
</body>
</html>