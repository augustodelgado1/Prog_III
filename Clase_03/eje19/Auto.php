
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

 -->

 <!-- 

Alumno : Augusto Delgado 
Div : A332
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



    private static function CrearUnAuto($_marca,$_color, $_precio = 0, $_fecha = null)
    {
        $unAuto = null;

        if(isset($_marca) && isset($_color) 
        && isset($_precio) )
        {
            $unAuto = new Auto($_marca,$_color,$_precio,$_fecha);
        }

        return $unAuto;
    }

    // /    Crear un método de clase para poder hacer el alta de un Auto, guardando los datos en un archivo
// autos.csv.
    public static function AltaDeAuto($nombreDeArchivo,$_marca,$_color, $_precio = 0, $_fecha = null)
    {
        $estado = false;
        $unAuto = null;

        if(($unAuto = Auto::CrearUnAuto($_marca,$_color,$_precio,$_fecha)) !== null)
        {
            $estado =  $unAuto->EscribirUnAutos($nombreDeArchivo);
        }

        return $estado;
    }

    private function EscribirUnAutos($nombreDeArchivo)
    {
        $estado = false;
        $unArchivo = fopen($nombreDeArchivo,"a+");

        if(isset($unArchivo))
        {
            $estado = fputcsv($unArchivo,array($this->_marca,$this->_color,$this->_precio,$this->_fecha));
            fclose($unArchivo);
        }

        return $estado;
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
    
            while(($linea = fgetcsv($unArchivo)) !== false){

                if(isset($linea) && ($unAuto = Auto::CrearUnAuto($linea[0],$linea[1], $linea[2], $linea[3])) !== null)
                {
                    array_push($listaDeAutos, $unAuto);
                }
            }

            fclose($unArchivo);
        }

        return   $listaDeAutos ;
    }

    // public static function EscribirArrayDeAutos($listaDeAutos,$nombreDeArchivo)
    // {
    //     $estado = false;
    //     $unArchivo = fopen($nombreDeArchivo,"w");

    //     if(isset( $unArchivo) && isset( $listaDeAutos)){
            
    //         $estado = true;
            
    //         foreach($listaDeAutos as $unAuto ){

    //             if(!$unAuto->EscribirUnAutos($unArchivo))
    //             {
    //                 $estado = false;
    //                 break;
    //             }
    //         }

           
    //         fclose($unArchivo);
    //     }

    //     return $estado;
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
            $data = "Color :$unAuto->_color"."<br>".
            "Precio : $unAuto->_precio"."<br>".
            "Marca : $unAuto->_marca"."<br>".
            "Fecha : $unAuto->_fecha"."<br>";
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