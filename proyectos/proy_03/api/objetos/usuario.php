<?php
class usuario{

    private $conn;
    public $id;
    public $id_colaborador;
    public $user;
    public $pass;
    public $name;
    public $rol;
    public $estado;
    
    //constructor con $db como conexion a base de datos
    public function __construct($db){
        $this->conn = $db;
       }

    public function login(){
        $query = "CALL sp_usuarios_login('".$this->user."', '".$this->pass."')";

        // preparar declaración de consulta
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row>0){
            $this->id = $row['id'];
            $this->id_colaborador = $row['id_colaborador'];
            $this->user = $row['usuario'];
            $this->pass = $row['pass'];
            $this->name = $row['nombre'];
            $this->rol = $row['rol'];
            $this->estado = $row['estado'];
        }

    }

    public function select_1(){
        $query = "CALL sp_usuarios_select_1(".$this->id_colaborador.")";

        // preparar declaración de consulta
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row>0){
            $this->id = $row['id'];
            $this->id_colaborador = $row['id_colaborador'];
            $this->user = $row['usuario'];
            $this->pass = $row['pass'];
            $this->name = $row['nombre'];
            $this->rol = $row['rol'];
            $this->estado = $row['estado'];
        }

    }

    public function listar(){
        $query = "CALL sp_usuarios_listar()";

        // preparar declaración de consulta
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;

    }

    public function agregar(){
        $query = "CALL sp_usuarios_insert(".$this->id_colaborador.",'".$this->user."','".$this->pass."','".$this->name."','".$this->rol."','".$this->estado."')";

        //preparar query
        $stmt = $this->conn->prepare($query);

            //execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function actualizar(){
        $query = "CALL sp_usuarios_update(".$this->id.",'".$this->pass."','".$this->name."','".$this->rol."','".$this->estado."')";

        //preparar query
        $stmt = $this->conn->prepare($query);

            //execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
    



}

?>