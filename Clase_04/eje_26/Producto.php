<!-- 
Aplicación No 25 ( AltaProducto)
Archivo: altaProducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST ,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un objeto y
utilizar sus métodos para poder verificar si es un producto existente, si ya existe el producto se le
suma el stock , de lo contrario se agrega al documento en un nuevo renglón
Retorna un :
“Ingresado” si es un producto nuevo
“Actualizado” si ya existía y se actualiza el stock.
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase
-->
<!-- 
Alumno : Augusto Delgado 
Div : A332
-->

<?php

require_once "Venta.php";

class Producto
{
    private static $_id;
    private $_codigoDeBarra;
    private $_nombre;
    private $_tipo;
    private $_stock;
    private $_precio;


    public function __construct($_codigoDeBarra,$_nombre,$_tipo,$_stock,$_precio) {
        
        self::$_id = Producto::CrearIdAutoIncremental();
        $this->_nombre = $_nombre;
        $this->_tipo = $_tipo;
        $this->_stock = $_stock;
        $this->_precio = $_precio;
        $this->_codigoDeBarra = $_codigoDeBarra;
    }

    public function RealizarVenta($unIdDeUsuario,$cantidadDeItem)
    {
        $unaVenta = null;

        if(isset($unIdDeUsuario) && $this->HayStock($cantidadDeItem) )
        {
            $unaVenta =  new Venta($unIdDeUsuario);
            $unaVenta->AddProducto($this->_codigoDeBarra,$cantidadDeItem);
        }

        return $unaVenta;
    }

    public function HayStock($cantidadDeItem)
    {
        $estado = false;

        if($this->_stock > 0 && $cantidadDeItem <= $this->_stock)
        {
            $this->_stock -=  $cantidadDeItem;
            $estado = true; 
        }

        return $estado;
    }

    private static function CrearIdAutoIncremental()
    {
        return  rand(1,10.000);
    }

    public function BuscarUnProducto($listaDeProductos)
    {
       $retorno = false;

       if(isset($listaDeProductos) && count($listaDeProductos) > 0)
       {
         $retorno = in_array($this,$listaDeProductos);
       }

       return $retorno;
    }

    public static function BuscarUnProductoPorCodigoDeBarra($listaDeProductos,$strCodigoDeBarra)
    {
        $unProductoABuscar = null;

        if(isset($listaDeProductos) && count($listaDeProductos) > 0)
        {
            foreach($listaDeProductos as $unProducto)
            {
                if($unProducto->_codigoDeBarra == $strCodigoDeBarra)
                {
                    $unProductoABuscar = $unProducto;
                   
                    break;
                }
            }
           
        }

        return $unProductoABuscar;
    }

    private function AgragarStock($listaDeProductos)
    {
        $estado = false;

        if(Producto::BuscarUnProducto($listaDeProductos) == true)
        {
            $this->_stock++;
            $estado = true;
        }

        return $estado;
    }
    

    public static function EscribirArrayPorJson($listaDeUsuario,$nombreDeArchivo)
    {
        $estado = false;
        $unArchivo = fopen($nombreDeArchivo,"a+");

        if(isset($unArchivo) && isset($listaDeUsuario) && count($listaDeUsuario) > 0 &&
        ($listaStr = Producto::SerializarArrayDeProductoJson($listaDeUsuario)) !== null)
        {
            $estado = fwrite($unArchivo ,json_encode($listaStr));
            fclose($unArchivo);
        }

        return $estado;
    }

    private static function SerializarArrayDeProductoJson($listaDeProductos)
    {
        $listaDeArrayAsosiativo = null;

        if( isset($listaDeProductos))
        {
            $listaDeArrayAsosiativo = [];

            foreach ($listaDeProductos as $unProducto)
            {
                array_push($listaDeArrayAsosiativo, $unProducto->ObternerDatos());
            }
        }

        return $listaDeArrayAsosiativo;
    }

    private function ObternerDatos() 
    {
        return array(
            '_id' => self::$_id,
            '_codigoDeBarra' => $this->_codigoDeBarra,
            '_nombre' => $this->_nombre,
            '_tipo' => $this->_tipo,
            '_stock' => $this->_stock,
            '_precio' => $this->_precio,
        );
    }

    

}
?>