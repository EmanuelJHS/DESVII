<?php

require_once('actividad_card.php');
class actividad extends actividad_card{

    //conexion de base de datos y tabla productos
    private $conn;

    //constructor con $db como conexion a base de datos
    public function __construct($db){
        $this->conn = $db;
    }

        //Procedimientos almacenados
         //Select
          //Listar con filtro
          public function consultar_actividades_filtro(){
            $query = "CALL sp_actividades_select_filtro('".$this->tipo."','".$this->dateIn."','".$this->dateOut."');";
                //sentencia para prepara query
                $stmt = $this->conn->prepare($query);

                //ejecutar query
                $stmt->execute();
    
                return $stmt;

        }
          
            public function consultar_actividades(){    

                $query = "CALL sp_actividades_select('".$this->dateIn."','".$this->dateOut."');";

                //sentencia para prepara query
                $stmt = $this->conn->prepare($query);

                //ejecutar query
                $stmt->execute();

                return $stmt;
            }

        
            public function consultar_actividades_1(){
                $query = "CALL sp_actividades_select_1('".$this->id."')";

                // preparar declaración de consulta
                $stmt = $this->conn->prepare( $query );
                // ID de enlace del producto a actualizar
                //$stmt->bindParam(1, $this->id);
                // ejecutar consulta
                $stmt->execute();
                // obtener fila recuperada
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if($row>0){
                    // establecer valores a las propiedades del objeto
                    
                    $this->tipo = $row['tipo'];
                    $this->titulo = $row['titulo'];
                    $this->ubicacion = $row['ubicacion'];
                    $this->descripcion = $row['descripcion'];
                    $this->correo = $row['correo'];
                    $this->repetir = $row['repetir'];
                    //
                    $this->allday = $row['allday'];
                    $this->dateIn = $row['fecha_in'];   
                    $this->dateOut = $row['fecha_out'];          
                    $this->timeIn = $row['fecha_in'];   
                    $this->timeOut = $row['fecha_out'];         

                }
            }

                //Agregar (Insert)
            public function agregar_actividad(){
                $query = "CALL sp_actividades_insert('".$this->tipo."','".$this->titulo."','".$this->ubicacion."','".$this->descripcion."','".$this->correo."','".$this->repetir."',".$this->allday.",'".$this->dateIn."','".$this->dateOut."')";

                //preparar query
                $stmt = $this->conn->prepare($query);

                    //execute query
                if($stmt->execute()){
                    return true;
                }

                return false;
            }


            //Eliminar (Delete)
            public function eliminar_actividad(){
                $query = "CALL sp_actividades_delete(".$this->id.")";
                //preparar query
                $stmt = $this->conn->prepare($query);

                //execute query
                if($stmt->execute()){
                    return true;
                }
                return false;
            }
                
                //Actualizar (Update)
                public function actualizar_actividad(){
                    $query = "CALL sp_actividades_update(".$this->id.",'".$this->tipo."','".$this->titulo."','".$this->ubicacion."','".$this->descripcion."','".$this->correo."','".$this->repetir."',".$this->allday.",'".$this->dateIn."','".$this->dateOut."')";
    
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