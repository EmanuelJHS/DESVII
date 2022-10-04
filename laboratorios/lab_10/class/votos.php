<?php

require_once('modelo.php');

class votos extends modeloCredencialesBD{

    public function __construct(){
        parent::__construct();
    }

    public function listar_votos(){
        $intruccion = "CALL sp_listar_votos()";

        $consulta=$this->_db->query($intruccion);
        $resultado=$consulta->fetch_all(MYSQLI_ASSOC);

        if($resultado){
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    public function actualizar_votos($votos1, $votos2){
        $intruccion = "CALL sp_actualizar_votos('".$votos1."','".$votos2."')";
        $actualiza=$this->_db->query($intruccion);

        if($actualiza){
            return $actualiza;
            $actualiza->close();
            $this->_db->close();
        }
    }
}


?>