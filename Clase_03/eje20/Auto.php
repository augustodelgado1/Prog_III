<!-- 

Alumno : Augusto Delgado 
Div : A332
-->

 <?php
Require_once "File.php" ;
class Auto
{
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    public function __construct($_marca,$_color, $_precio = 0, $_fecha = null)
    {
        $this->_color = $_color;
        $this->_precio = $_precio;
        $this->_marca = $_marca;
        $this->_fecha = $_fecha;
    }

   

    public static function AltaDeAuto($_marca,$_color, $_precio = 0, $_fecha = null)
    {
        $unAuto = null;

        if(isset($_marca) && isset($_color) 
        && isset($_precio) )
        {
            $unAuto = new Auto($_marca,$_color,$_precio,$_fecha);
        }

        return $unAuto;
    }
    public static function EscribirListaDeAutos($listaDeAutos,$archivo)
    {
        $estado = false;

        if(isset( $archivo) && isset($listaDeAutos)){
            
            $estado = true;
            
            foreach($listaDeAutos as $unAuto ){

                if(!$unAuto->EscribirUnAutos($archivo))
                {
                    $estado = false;
                    break;
                }
            }
        }

        return $estado;
    }

    
    private function EscribirUnAutos($unArchivo)
    {
        $estado = false;

        if(isset( $unArchivo) ){

            $estado = fputcsv($unArchivo,array($this->_marca,$this->_color,$this->_precio,$this->_fecha));
        }

        return $estado;
    }



    
    // public function __set($atributo, $valor)
    // {
        
    //     if(!property_exists($this, $atributo))
    //     {
    //         $this->propiedades[$atributo] = $valor;
    //     }
    // }

    // public function __get($atributo)
    // {
    //     $retorno = null;
        
    //     if(in_array($atributo, $this->_propiedades))
    //     {
    //         $retorno = $this->_propiedades[$atributo];
    //     }

    //     return $retorno;
    // }


//     Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble por
// parámetro y que se sumará al precio del objeto.

public function AgregarImpuestos($impuestoAgregado)
{
    if($impuestoAgregado > 0)
    {
        $this->_precio += $impuestoAgregado;
    }
}

// // //     Realizar un método de clase llamado “MostrarAuto”, que 
// // recibirá un objeto de tipo “Auto” por
// // // parámetro y que mostrará todos los atributos de dicho objeto.

public static function MostrarAuto($unAuto)
{
    $data = null;
    
    if($unAuto != null)
    {
        $data = "Color :$unAuto->_color".PHP_EOL.
        "Precio : $unAuto->_precio".PHP_EOL.
        "Marca : $unAuto->_marca".PHP_EOL.
        "Fecha : $unAuto->_fecha".PHP_EOL;
    }

    return $data;
}

// //    Crear el método de instancia “Equals” que permita 
// comparar dos objetos de tipo “Auto”. Sólo
// // devolverá TRUE si ambos “Autos” son de la misma marca.

public function Equals($unAuto)
{
    $bool = false;

    if($unAuto != null)
    {
        $bool = (strcmp($this->_marca,$unAuto->_marca) == 0);
    }

    return $bool;
}

// // //     Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” 
// (sólo si son de la
// // // misma marca, y del mismo color, de lo contrario informarlo) 
// // y que retorne un Double con la suma
// // // de los precios o cero si no se pudo realizar la operación.

public static function Add($unAuto,$otroAuto)
{
    $sumaPrecio = 0;

    if($unAuto != null && $unAuto->Equals($otroAuto) == true && 
    strcmp($unAuto->_color,$otroAuto->_color) == 0)
    {
        $sumaPrecio = $unAuto->_precio + $otroAuto->_precio;
    }

    return $sumaPrecio;
}


}


 ?>