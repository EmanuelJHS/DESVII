<?php
class marcacion{

    private $conn;
    public $id;
    public $id_colaborador;
    public $fecha;
    public $fechaIn;
    public $fechaOut; 
    public $hora;


    //constructor con $db como conexion a base de datos
    public function __construct($db){
         $this->conn = $db;
        }

        public function select_1(){
            $query = "CALL sp_marcaciones_select_1(".$this->id_colaborador.",'".$this->fechaIn."','".$this->fechaOut."')";
    
            // preparar declaración de consulta
            $stmt = $this->conn->prepare( $query );
            $stmt->execute();
    
            return $stmt;

            // $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // if($row>0){
            //     $this->id = $row['id'];
            //     $this->id_colaborador = $row['id_colaborador'];
            //     $this->name = $row['nombre'];
            //     $this->fecha = $row['fecha'];
            //     $this->hora = $row['hora'];
            // }
            
    
        }

        public function select_last(){
            $query = "CALL sp_marcaciones_select_last(".$this->id_colaborador.")";
    
            // preparar declaración de consulta
            $stmt = $this->conn->prepare( $query );
            $stmt->execute();
    
            return $stmt;
    
        }



        public function agregar(){
            $query = "CALL sp_marcaciones_insert(".$this->id_colaborador.",'".$this->fecha."','".$this->hora."')";
    
            //preparar query
            $stmt = $this->conn->prepare($query);
    
                //execute query
            if($stmt->execute()){
                return true;
            }
    
            return false;
        }

        
    public function actualizar(){
        $query = "CALL sp_marcaciones_update(".$this->id.",'".$this->fecha."','".$this->hora."')";

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