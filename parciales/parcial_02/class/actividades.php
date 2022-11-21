<?php

require_once('modelo.php');

class actividades extends modeloCredencialesBD{
    private $_id;
    private $_titulo;
    private $_date_in;
    private $_date_out;
    private $_ubicacion;
    private $_email;
    private $_tipo; //Tipo de actividad
    private $_allday; //Si se repite o no  (de no repetirse todo el dia, especificar rango de tiempo).
    private $_repetir;
    //Propiedades adicionales
    private $descripcion; //Detalle de la actividad.


    //Constructor
    public function __construct(){
        parent::__construct();
    }


    //Procedimientos almacenados
    //Select
    //Listar con filtro
    public function consultar_actividades($fecha_in, $fecha_out){
        $instruccion = "CALL sp_actividades_select('".$fecha_in."','".$fecha_out."');";

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

    public function consultar_actividades_1($pid){
        $instruccion = "CALL sp_actividades_select_1('".$pid."')";

        $consulta= $this->_db->query($instruccion);
        $resultado= $consulta->fetch_all(MYSQLI_ASSOC);

        if(!$resultado ){
            echo "Fallo al consultar las actividades";
        }else{
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    public function consultar_actividades_filtro($tipo,$fecha_in, $fecha_out){
        $instruccion = "CALL sp_actividades_select_filtro('".$tipo."','".$fecha_in."','".$fecha_out."');";

        $consulta= $this->_db->query($instruccion);
        $resultado= $consulta->fetch_all(MYSQLI_ASSOC);

        if($resultado<0){
            echo "Fallo al consultar las actividades";
            //return $resultado;
        }else{
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }


    //Agregar (Insert)
    public function agregar_actividad($tipo,$titulo,$ubicacion,$descripcion,$correo,$repetir,$allday,$date_in,$date_out){
        $intruccion = "CALL sp_actividades_insert('".$tipo."','".$titulo."','".$ubicacion."','".$descripcion."','".$correo."','".$repetir."',".$allday.",'".$date_in."','".$date_out."')";
        $resultado=$this->_db->query($intruccion);

        if($resultado ){
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    //Eliminar (Delete)
    public function eliminar_actividad($pid){
        $intruccion = "CALL sp_actividades_delete(".$pid.")";
        $resultado=$this->_db->query($intruccion);

        if($resultado ){
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    //Actualizar (Editar, Update)
    public function actualizar_actividad($pid,$tipo,$titulo,$ubicacion,$descripcion,$correo,$repetir,$allday,$date_in,$date_out){
        $intruccion = "CALL sp_actividades_update(".$pid.",'".$tipo."','".$titulo."','".$ubicacion."','".$descripcion."','".$correo."','".$repetir."',".$allday.",'".$date_in."','".$date_out."')";
        $resultado=$this->_db->query($intruccion);

        if($resultado ){
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }
}

?>