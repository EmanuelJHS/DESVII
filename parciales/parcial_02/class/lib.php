<?php

class lib {

    public function __construct(){}

    public function nFactorial($numero){
        if($numero > 0)
        {
            $resultado = 1;
            for ($i=$numero; $i > 0; $i--){
            $resultado = $resultado * $i;
            }
            //echo "Resultado: ". $resultado;
            return $resultado;
        }else{
            echo "Favor de introducir un numero mayor a 0.";
        }
    }

    public function nSumatoria($numero){

        return ($numero-1)/$this->nFactorial($numero);
    
    }

}

?>