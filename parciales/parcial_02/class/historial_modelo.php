<?php

class historial_modelo{

    private $id;
    private $nvalue; //Tipo de actividad
    private $factorial;
    private $sumatoria;

    public function __construct(){}

    public function setId($s){
        $this->id = $s;
    }

    public function getId(){
        return $this->id;
    }

    public function setNvalue($s){
        $this->nvalue = $s;
    }

    public function getNvalue(){
        return $this->nvalue;
    }

    public function setFactorial($s){
        $this->factorial = $s;
    }

    public function getFactorial(){
        return $this->factorial;
    }

    public function setSumatoria($s){
        $this->sumatoria = $s;
    }

    public function getSumatoria(){
        return $this->Sumatoria;
    }
    

}

?>