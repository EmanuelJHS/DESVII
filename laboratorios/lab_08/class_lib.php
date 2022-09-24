<?php  

//Laboratio 8
//Objetivo: poner en practica aplicaciones orientadas a objetos en PHP

//Laboratio 8.1 (Laboratorio 4.1)
//Aplicacion web con Imagen dinamica.
class Clasificador{

    private $calificacion;
    private $image;

    function __construct($c){
        $this->calificacion = $c;
    }

    function obtener_calificacion(){
        if($this->calificacion > 79){
            $image = "./_img/good.jpg";
            echo '<img src="' . $image . '"/>';
        }elseif($this->calificacion > 49){
            $image = "./_img/normal.jpg";
            echo '<img src="' . $image . '"/>';
        }else{
            $image = "./_img/bad.jpg";
            echo '<img src="' . $image . '"/>';
        }
    }

}

//Laboratio 8.2 (Laboratorio 4.2)
//Calculo de un factorial de acuerdo a un valor de entrada.
class Factorial{
    private $numero;

    function __construct($n){
        $this->numero = $n;
    }

    function obtener_factorial(){
        if($this->numero > 0)
        {
         $resultado = 1;
        for ($i=$this->numero; $i > 0; $i--){
            $resultado = $resultado * $i;
        }
    
          return "Resultado: ". $resultado;
        }else{
         return "Favor de introducir un numero mayor a 0.";
        }
    }


}


//Laboratio 8.3 (Laboratorio 4.3)
//Manejo de arreglo P1

class Arreglo_p1{
    private $size_array;
    private $arreglo;

    function __construct($n){
        $this->size_array = $n;
    }

     function seRepite($valor, $arr){
        $resultado = FALSE;

         for($i=0; $i < sizeof($arr)-1; $i++ ){

            if($valor == $arr[$i]){
               // echo "f - Posiccion: " . $i." Valor: ". $valor. " | ". $arreglo[$i]. "<br>";
                $resultado = TRUE;
                return $resultado;
            }
         }
         
             return $resultado;
    }

    function buscarPosicion($valor, $arr){
    for($i=0; $i < sizeof($arr); $i++){

        if ($valor == $arr[$i]){
            return $i;
        }

        }
    }

    function obtener_maximo(){
        echo "<br><br.";
        $valorMaximo = max($this->arreglo);
        echo " ". $valorMaximo . " <br/>";
        echo "Valor maximo: ". $valorMaximo.", en la posicion: ". ( $this->buscarPosicion($valorMaximo, $this->arreglo) + 1) . " <br/>";
    }

    function llenar_imprimir_arreglo(){
    //Definir el arreglo
    $_arg = array('');
    //LLenando el arreglo
    for ($i=0; $i<$this->size_array; $i++){
        //Asegurando que no se repitan los numeros.
       do {
            $_arg[$i]= rand(0,100) + rand(1,50);

          $aux = $this->seRepite($_arg[$i], $_arg); 
            
        }while( $aux > 0 );

        echo "Posicion: ". ($i + 1) ." | Valor: " . $_arg[$i] . " | ". $aux."<br>";
    }
    $this->arreglo = $_arg; //pasando arreglo
   // obtener_maximo();
}




}


?>