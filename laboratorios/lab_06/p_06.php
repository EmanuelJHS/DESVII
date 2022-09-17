<?php

final class claseBase{
    public function test(){
        echo "ClaseBase::test() llamada\n";
    }

    //Aqui da igual si se declara el metodo como final o no 
    final public function moreTesting(){
        echo "ClaseBase::moreTesting() llamada \n";
    }
}

class ClaseHijo extends ClaseBase{

}

//Salida:
//Fatal error: Class ClaseHijo cannot extend final class claseBase
//no se puede heredar de una clase final.

?>