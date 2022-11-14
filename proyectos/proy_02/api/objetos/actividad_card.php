<?php
class actividad_card{

    //private $plantilla ="";
    private $id;
    private $tipo; //Tipo de actividad
    private $titulo;
    private $dateIn;
    private $dateOut;
    private $timeIn;
    private $timeOut;
    private $ubicacion;
    private $correo;
    private $allday; //Si se repite o no  (de no repetirse todo el dia, especificar rango de tiempo).
    private $repetir;
    //Propiedades adicionales
    private $descripcion; //Detalle de la actividad.

    function __construct() {
        
    }

    public function setId($s){
        $this->id = $s;
    }

    public function getId(){
        return $this->id;
    }

    public function setTipo($s){
        $this->tipo = $s;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function setTitulo($s){
        $this->titulo = $s;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function setDateIn($s){
        $this->dateIn = $s;
    }

    public function getDateIn(){
        return $this->dateIn;
    }

    public function setTimeIn($s){
        $this->timeIn = $s;
    }

    public function getTimeIn(){
        return $this->timeIn;
    }

    public function setDateOut($s){
        $this->dateOut = $s;
    }

    public function getDateOut(){
        return $this->dateOut;
    }

    public function setTimeOut($s){
        $this->timeOut = $s;
    }

    public function getTimeOut(){
        return $this->timeOut;
    }


    public function setUbicacion($s){
        $this->ubicacion = $s;
    }

    public function getUbicacion(){
        return $this->ubicacion;
    }

    public function setCorreo($s){
        $this->correo = $s;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function setAllDay($s){
        $this->allDay = $s;
    }

    public function getAllDay(){
        return $this->allDay;
    }

    public function setRepetir($s){
        $this->repetir = $s;
    }

    public function getRepetir(){
        return $this->repetir;
    }

    public function setDescripcion($s){
        $this->descripcion = $s;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }



    

}




?>