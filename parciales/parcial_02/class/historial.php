<?php

require_once('modelo.php');

 $id;
 $nvalue; //Tipo de actividad
 $factorial;
 $sumatoria;

class historial extends modeloCredencialesBD{


    //Constructor
    public function __construct(){
        parent::__construct();
    }

    public function select(){
        $instruccion = "CALL sp_parcial2_select();";

        $consulta= $this->_db->query($instruccion);
        $resultado= $consulta->fetch_all(MYSQLI_ASSOC);

        //echo "<br>actividades.php resultado: ".count($resultado)."<br>";

        if($resultado<0){
        //if(!$resultado){
            echo "Fallo al consultar las actividades";
            //return $resultado;
        }else{
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    public function select_1($pid){
        $instruccion = "CALL sp_parcial2_select(".$pid.");";

        $consulta= $this->_db->query($instruccion);
        $resultado= $consulta->fetch_all(MYSQLI_ASSOC);

        //echo "<br>actividades.php resultado: ".count($resultado)."<br>";

        if($resultado<0){
        //if(!$resultado){
            echo "Fallo al consultar las actividades";
            //return $resultado;
        }else{
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }


    public function insert($nvalue, $nfactorial, $nsumatoria){
        $intruccion = "CALL sp_parcial2_insert(".$nvalue.",'".$nfactorial."','".$nsumatoria."')";
        $resultado=$this->_db->query($intruccion);

        if($resultado ){
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    public function update($pid,$nvalue, $nfactorial, $nsumatoria){
        $intruccion = "CALL sp_parcial2_update(".$pid.",".$nvalue.",'".$nfactorial."','".$nsumatoria."')";
        $resultado=$this->_db->query($intruccion);

        if($resultado ){
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

}


?>