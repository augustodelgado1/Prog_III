
<!-- 
Parte 5 - Ejercicios con POO + Archivos

Aplicación No 19 (Auto)
Realizar una clase llamada “Auto” que posea los siguientes atributos

privados: _color (String)
_precio (Double)
_marca (String).
_fecha (DateTime)

Realizar un constructor capaz de poder instanciar objetos pasándole como

parámetros: i. La marca y el color.

ii. La marca, color y el precio.
iii. La marca, color, precio y fecha.

Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble por
parámetro y que se sumará al precio del objeto.
Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto” por
parámetro y que mostrará todos los atributos de dicho objeto.
Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo devolverá
TRUE si ambos “Autos” son de la misma marca.
Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son de la
misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con la suma de los
precios o cero si no se pudo realizar la operación.





Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);
En testAuto.php:
 Crear dos objetos “Auto” de la misma marca y distinto color.
 Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
 Crear un objeto “Auto” utilizando la sobrecarga restante.
 Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500 al
atributo precio.
 Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el resultado
obtenido.
 Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no.
 Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3, 5)


Crear un método de clase para poder hacer el alta de un Auto, guardando los datos en un archivo
autos.csv.
Hacer los métodos necesarios en la clase Auto para poder leer el listado desde el archivo
autos.csv
Se deben cargar los datos en un array de autos.

Augusto Delgado
 -->

 <?php

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


//    Crear un método de clase para poder hacer el alta de un Auto, guardando los datos en un archivo
// autos.csv.

    public static function EscribirUnAuto($unAuto,$nombreDeArchivo)
    {
        return Auto::EscribirArrayDeAutos(array($unAuto),$nombreDeArchivo);
    }

// Hacer los métodos necesarios en la clase Auto para poder leer el listado desde el archivo
// autos.csv Se deben cargar los datos en un array de autos.

    public static function LeerCsv($nombreDeArchivo)
    {
        $listaDeAutos  = null;
         $unAuto  = null;
        $unArchivo = fopen($nombreDeArchivo,"r");

        if(isset($unArchivo)){

            $listaDeAutos = [];
    
            while(($unAuto = fgetcsv($unArchivo)) !== false){

                if(isset($unAuto))
                {
                  
                    array_push($listaDeAutos, new Auto($unAuto[0],$unAuto[1],$unAuto[2],$unAuto[3]));
                }
            }

            fclose($unArchivo);
        }

        return   $listaDeAutos ;
    }

    // private static function Convert($datos)
    // {
    //     $unAuto  = null;

    //     if(isset($datos) && Auto::VerificarAtributos($datos) !== false)
    //     {
    //         $unAuto  = new Auto($datos["marca"],$datos["color"],$datos["precio"],$datos["fecha"]);
    //     }

    //     return   $unAuto ;
    // }

    // private static function VerificarAtributos($datos)
    // {
    //     $estado = false;

    //     if(isset($datos))
    //     {
    //         $estado = true;

    //         foreach($datos as $key => $value)
    //         {
    //             if(!property_exists(__CLASS__, $key))
    //             {
    //                 $estado = false;
    //                 break;
    //             }
    //         }
    //     }

    //     return   $estado ;
    // }
    public static function EscribirArrayDeAutos($listaDeAutos,$nombreDeArchivo)
    {
        $estado = false;
        $unArchivo = fopen($nombreDeArchivo,"w");

        if(isset( $unArchivo) && isset( $listaDeAutos)){
            
            $estado = true;
            
            foreach( $listaDeAutos as $unAuto ){

                if(!fputcsv($unArchivo,array($unAuto->_marca,$unAuto->_color,$unAuto->_precio,$unAuto->_fecha)))
                {
                    $estado = false;
                    break;
                }
            }

           
            fclose($unArchivo);
        }

        return $estado;
    }


}


 ?>