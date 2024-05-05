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

    private static function CrearIdAutoIncremental()
    {
       
        return  rand(1,10.000);
    }

//     Retorna un :
// “Ingresado” si es un producto nuevo
// “Actualizado” si ya existía y se actualiza el stock.
// “no se pudo hacer“si no se pudo hacer
    public function EvaluarUnProducto($listaDeProductos,$nombreDeArchivo)
    {
        $mensaje = "no se pudo hacer";

        if(isset($listaDeProductos))
        {
            if($this->AgragarStock($listaDeProductos))
            {
                $mensaje = "“Actualizado”";
                
            }else{

                if($this->EscribirUnProductoPorJson($nombreDeArchivo))
                {
                    $mensaje = "Ingresado";
                }
            }
        }
        
        return $mensaje;
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

    public function EscribirUnProductoPorJson($nombreDeArchivo)
    {
        $estado = false;
        $unArchivo = fopen($nombreDeArchivo,"a+");

        if(isset($unArchivo) )
        {
            $estado = fwrite($unArchivo ,json_encode($this->ObternerDatos()));
            fclose($unArchivo);
        }

        return $estado;
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

    public static function EscribirArrayPorJson($listaDeUsuario,$nombreDeArchivo)
    {
        $estado = false;
        $unArchivo = fopen($nombreDeArchivo,"w");

        if(isset($unArchivo) && isset($listaDeUsuario) && count($listaDeUsuario) > 0 &&
        ($listaDeArrayAsociativos = Producto::SerializarArrayDeProductoJson($listaDeUsuario)) !== null)
        {
            $estado = fwrite($unArchivo ,json_encode($listaDeArrayAsociativos));
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

    public static function ObtenerUnProductoPorArrayAsosiativo($unArrayAsosiativo)
    {
        $unProducto = null;

        if(Producto::ValidarKeys($unArrayAsosiativo) == true)
        {
            // echo "entro";
            $unProducto = new Producto($unArrayAsosiativo['_codigoDeBarra'],$unArrayAsosiativo['_nombre'],
            $unArrayAsosiativo['_tipo'], $unArrayAsosiativo['_stock'], $unArrayAsosiativo['_precio']);
            // $unProducto::$_id = $unArrayAsosiativo['_id'];
        }
        
        return $unProducto;
    }

    private static function ValidarKeys($unArrayAsosiativo)
    {
        $estado = false;

        if(isset($unArrayAsosiativo) && count($unArrayAsosiativo) > 0)
        {
            $estado = true;
            foreach($unArrayAsosiativo as $key => $value)
            {
                if(!property_exists(__CLASS__, $key))
                {
                    $estado = false;
                    break;
                }
            }
        }

        return $estado;
    }

    

}
?>