<?php 
//Laboratorio 7.1: Creación y uso de constantes en una clase
class MiClase {
    const constante = 'Valor constante';
    function mostrarConstante(){
        echo self::constante. "\n";
    }
}


//Laboratorio 7.2: Abstracción de objetos
abstract class ClaseAbstracta{
    //Se fuerza la herencia de la clase para definir estos metodos
    abstract protected function tomarValor();
    abstract protected function prefixValor($prefix);

    //Metodo comun
    public function printOut(){
        print $this->tomarValor(). "<br>";
    }
}

class ClaseConcreta1 extends ClaseAbstracta{
    protected function tomarValor(){
        return "ClaseConcreta1";
    }

    public function prefixValor($prefix){
        return "{$prefix}ClaseConcreta1";
    }
}

class ClaseConcreta2 extends ClaseAbstracta{
    protected function tomarValor(){
        return "ClaseConcreta2";
    }

    public function prefixValor($prefix){
        return "{$prefix}ClaseConcreta2";
    }
}


//Laboratorio 7.3: Interfaces
interface iTemplate{
    public function ponerVariable($nombre, $var);
    public function verHtml($template);
}

class Template Implements iTemplate{
    private $vars = array();
    public function ponerVariable($nombre, $var){
        $this->vars[$nombre] = $var;
    }

    public function verHtml($template){
        foreach($this->vars as $nombre => $value){
            $template = str_replace('{'.$nombre.'}', $value,$template);
        }
        return $template;
    }
}

//Laboratorio 7.5: Clonación de objetos
class SubObject{
    static $instances = 0;
    public $instance;

    public function __construct(){
        $this->instance = ++self::$instances;
    }

    public function __clone(){
        $this->instance = ++self::$instances;
    }
}

class MyCloneable{
    public $object1;
    public $object2;

    function __clone(){
        //Forzar una copia de this->is_object
        $this->object1 = clone $this->object1;
    }
}

//Laboratorio 7.6: Uso de formularios en orientación a objetos 
class Cilindro{
    protected $pi;
    protected $diametro;
    protected $altura;
    protected $radio;

    function __construct($d, $a){
        $this->diametro = $d;
        $this->altura = $a;
        $this->pi = 3.141593;
        $this->radio = $d/2;
    }

    function obtener_radio(){
        return $radio;
    }

    function calc_volumen(){
        return $this->pi*$this->radio*$this->radio*$this->altura;
    }

    function calc_area(){
        return 2*$this->pi*$this->radio*($this->radio+$this->altura);
    }
}

?>