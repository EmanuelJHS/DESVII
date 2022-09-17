<?php

class ClaseBase{
    public function test(){
            echo "ClaseBase::text() llamada \n";
    }

    final public function masTest(){
        echo "ClaseBase::masTests() llamada \n";
    }
}

class ClaseHijo extends ClaseBase{
    public function masTest(){
            echo "ClaseHijo::masTests() llamada\n";
    }
}


//SALIDA:
//Fatal error: Cannot override final method ClaseBase::masTest()
//No se puede sobreescribir los metodos finales.
?>