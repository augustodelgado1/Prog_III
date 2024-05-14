
<!-- B- (1 pt.) PizzaCarga.php: 
(por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
identificador(emulado) .
Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente. -->

<?php

require_once 'Ventas.php';

class Pizza
{
    private static $id;
    private $precio;
    private $stock;
    private $tipo;
    private $sabor;

    public function __construct($precio,$stock,$tipo,$sabor) {
        $this->precio = $precio;
        $this->stock = $stock;
        $this->tipo = $tipo;
        $this->sabor = $sabor;
        self::$id = rand(1,10000);
    }

    public function RealizarVenta($email,$cantidad)
    {
        $unaVenta = null;

        if(isset($email) && $this->stock > 0 && $cantidad > 0 && $cantidad <= $this->stock)
        {
            $unaVenta = new Ventas($email,self::$id,$cantidad);
            $this->stock -= $cantidad;
        }

        return $unaVenta;
    }

    public static function EscribirPizzaEnArrayJson($listaDePizzas,$nombreDeArchivo)
    {
        $estado = false; 
        $unArchivo = fopen($nombreDeArchivo,"w");
        $listaDeArrayAsosiativos = null;

        if(isset($listaDePizzas) && isset($unArchivo)
        && ($listaDeArrayAsosiativos = Pizza::SerializarListaJson($listaDePizzas)) !== null)
        {
            $estado = fwrite($unArchivo, json_encode( $listaDeArrayAsosiativos));
        }

        return  $estado ;
    }

    public static function BuscarPizzaPorSabor($listaDePizzas,$sabor)
    {
        $unaPizzaABuscar = null; 

        if(isset($listaDePizzas) )
        {
            foreach($listaDePizzas as $unaPizza)
            {
                if($unaPizza->sabor == $sabor)
                {
                    $unaPizzaABuscar = $unaPizza; 
                    break;
                }
            }
        }

        return  $unaPizzaABuscar;
    }

    
    public static function BuscarPizzaPorSaborYTipo($listaDePizzas,$tipo ,$sabor)
    {
        $unaPizzaABuscar = null; 

        if(isset($listaDePizzas) && isset($tipo) &&  isset($sabor) &&
        ($listaDeTipos = Pizza::FiltrarPorTipo($listaDePizzas,$tipo)) !== null)
        {
            $unaPizzaABuscar = Pizza::BuscarPizzaPorSabor($listaDeTipos,$sabor);
        }

        return  $unaPizzaABuscar;
    }

    public static function FiltrarPorTipo($listaDePizzas,$tipo)
    {
        $listaDeTipoDePizza = null;

        if(isset($listaDePizzas) && isset($tipo) && count($listaDePizzas) > 0)
        {
            $listaDeTipoDePizza =  [];

            foreach($listaDePizzas as $unaPizza)
            {
                if($unaPizza->tipo == $tipo)
                {
                    array_push($listaDeTipoDePizza,$unaPizza);
                }
            }
        }

        return  $listaDeTipoDePizza;
    }
//     <!-- B- (1 pt.) PizzaCarga.php: 
// (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
// guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
// identificador(emulado) .
// Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente. -->
    public function ActualizarPizza($precio,$stock)
    {
        if(isset($precio) && isset($stock) 
        && $stock > 0 && $precio > 0)
        {
            $this->precio = $precio;
            $this->stock += $stock;
        }
    }

    private static function SerializarListaJson($listaDePizzas)
    {
        $listaDeArrayAsosiativos = null; 

        if(isset($listaDePizzas))
        {
            $listaDeArrayAsosiativos = [];

            foreach($listaDePizzas as $unaPizza)
            {
                array_push($listaDeArrayAsosiativos,$unaPizza->ObtenerDatos());
            }
        }

        return  $listaDeArrayAsosiativos ;
    }

    public static function LeerListaJson($nombreDeArchivo)
    {
        $unArchivo = fopen($nombreDeArchivo,"r");
        $listaDeArrayAsosiativos = null;
        $listaDePizza = null;
        if(isset($unArchivo) &&  $unArchivo !== false)
        {
            $strJson = fgets($unArchivo);
            $listaDeArrayAsosiativos =  json_decode($strJson,true);
            $listaDePizza = Pizza::DeserializarListaJson($listaDeArrayAsosiativos);
        }

        return  $listaDePizza;
    }

    private static function DeserializarListaJson($listaDeArrayAsosiativos)
    {
        $listaDePizza = null; 

        if(isset($listaDeArrayAsosiativos))
        {
            $listaDePizza = [];

            foreach($listaDeArrayAsosiativos as $unaArrayAsosiativo)
            {
                array_push($listaDePizza,new Pizza($unaArrayAsosiativo['precio'],$unaArrayAsosiativo['stock'],$unaArrayAsosiativo['tipo'],$unaArrayAsosiativo['sabor']));
            }
        }

        return  $listaDePizza ;
    }

    // $this->precio = $precio;
    // $this->stock = $stock;
    // $this->tipo = $tipo;
    // $this->sabor = $sabor;
    // self::$id = rand(1,10000);

    private function ObtenerDatos()
    {
        return array(
            'stock' => $this->stock,
            'precio' => $this->precio,
            'tipo' => $this->tipo,
            'sabor' => $this->sabor,
            'id' => self::$id,
        );
    }


    // $estado = false; 

    // return  $estado ;
}

?>