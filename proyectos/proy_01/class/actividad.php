<?php

require_once('modelo.php');

class actividad extends modeloCredencialesBD{
    private $titulo;
    private $fecha;
    private $hora;
    private $ubicacion;
    private $email;
    private $tipo; //Tipo de actividad
    private $duracion; //Si se repite o no  (de no repetirse todo el dia, especificar rango de tiempo).

    //Propiedades adicionales
    private $descripcion; //Detalle de la actividad.


    //Constructor
    public function __construct(){
        parent::__construct();
    }


    //Procedimientos almacenados
    //Listar
    public function consultar_noticias(){
        $instruccion = "CALL sp_listar_noticias()";

        $consulta = $this->_db->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);

        if(!$resultado){
            echo "Fallo al consultar las noticias";
        }else{
            return $resultado;
            $resultado->close();
            $this->_db->clone();
        }
    }

    //Listar con filtro
    public function consultar_noticias_filtro($campo, $valor){
        $instruccion = "CALL sp_listar_noticias_filtro('".$campo."','".$valor."');";

        $consulta= $this->_db->query($instruccion);
        $resultado= $consulta->fetch_all(MYSQLI_ASSOC);


        if($resultado){
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    //Actualizar (Editar, Update)
    public function actualizar_votos($votos1, $votos2){
        $intruccion = "CALL sp_actualizar_votos('".$votos1."','".$votos2."')";
        $actualiza=$this->_db->query($intruccion);

        if($actualiza){
            return $actualiza;
            $actualiza->close();
            $this->_db->close();
        }
    }

    //Eliminar (Delete)

    //Agregar (Insert)
}

?>