<?php
class usuario{
    private $id;
    private $id_colaborador;
    private $user;
    private $pass;
    private $name;
    private $rol;
    private $estado;


    // function __contruct(){
        
    // }

    // function __construct($id, $id_colaborador, $user, $pass, $name, $rol, $estado) {
    //     $this->id = $id;
    //     $this->id_colaborador = $id_colaborador;
    //     $this->user = $user;
    //     $this->pass = $pass;
    //     $this->name = $name;
    //     $this->rol = $rol;
    //     $this->estado = $estado;
    // }

    public function setId($s){
        $this->id = $s;
    }

    public function getId(){
        return $this->id;
    }

    public function setIdColaborador($s){
        $this->id_colaborador = $s;
    }

    public function getIdColaborador(){
        return $this->id_colaborador;
    }

    public function setUser($s){
        $this->user = $s;
    }

    public function getUser(){
        return $this->user;
    }

    public function setPass($s){
        $this->pass = $s;
    }

    public function getPass(){
        return $this->pass;
    }

    public function setName($s){
        $this->name = $s;
    }

    public function getName(){
        return $this->name;
    }

    public function setRol($s){
        $this->rol = $s;
    }

    public function getRol(){
        return $this->rol;
    }

    public function setEstado($s){
        $this->estado = $s;
    }

    public function getEstado(){
        return $this->estado;
    }




}

?>