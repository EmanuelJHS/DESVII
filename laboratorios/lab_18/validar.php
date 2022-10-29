<?php

    class Validar{
        private $psw = false;
        private $psw_r = false;
        private $mail = false;
        private $ip = false;

        function setPsw($s){
            $this->psw = $s;
        }
        function getPsw(){
           return $this->psw;
        }
        function setPsw_r($s){
            $this->psw_r = $s;
        }
        function getPsw_r(){
           return $this->psw_r;
        }
        function setIp($s){
            $this->ip = $s;
        }
        function getIp(){
           return $this->ip;
        }
        function setMail($s){
            $this->mail = $s;
        }
        function getMail(){
           return $this->mail;
        }

        function registrar_usuario(){
            if(self::getPsw() && self::getPsw_r() && self::getIp() && self::getMail() ){
                return true;
            }else{
                return false;
            }
        }

        function verificar_email($email)
            {
            if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email))
            {
            return true;
            }
            return false;
            }

        function verificar_password_strenght($password)
        {
             if (preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $password)){
             echo "Su password es seguro.";
             return true;

            }else{
             echo "Su password no es seguro.";
             return false;

            }
        }

        function verificar_ip($ip)
            {
             return preg_match("/^([1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])" .
            "(\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3}$/", $ip );
            }

    }


?>