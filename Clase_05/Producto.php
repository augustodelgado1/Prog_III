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
    private static $id;
    private $codigoDeBarra;
    private $nombre;
    private $tipo;
    private $stock;
    private $precio;
    private static $fechaDeCreacion;
    private static $fechaDeModificacion;


    public function __construct($codigoDeBarra,$nombre,$tipo,$stock,$precio) {
        
        self::$id = Producto::CrearIdAutoIncremental();
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->stock = $stock;
        $this->precio = $precio;
        $this->codigoDeBarra = $codigoDeBarra;
        self::$fechaDeCreacion = date("Y-m-d");
        self::$fechaDeModificacion = date("Y-m-d");
    }
    private static function CrearIdAutoIncremental()
    {
        return  rand(1,10000);
    }

    public static function ObtenerListaDeProductosBD()
    {
        $listaDeProductos = null;
        $unObjetoAccesoDato = AccesoDatos::ObtenerUnObjetoPdo();
        $consulta = null;
        if(isset($unObjetoAccesoDato))
        {
            $consulta = $unObjetoAccesoDato->RealizarConsulta("SELECT * FROM producto as p");
            $estado = $consulta->execute();
            $listaDeProductos = $consulta->fetchAll(Pdo::FETCH_ASSOC);
        }

        return  $listaDeProductos;
    }

    // private static $id;
    // private $codigoDeBarra;
    // private $nombre;
    // private $tipo;
    // private $stock;
    // private $precio;
    // private static $fechaDeCreacion;
    // private static $fechaDeModificacion;

    public static function ObtenerUnProductoPorArrayAsosiativo($unArrayAsosiativo)
    {
        $unProducto = null;

        if(Producto::ValidarKeys($unArrayAsosiativo))
        {
            $unProducto = new Producto($unArrayAsosiativo['codigoDeBarra'],$unArrayAsosiativo['nombre'],
            $unArrayAsosiativo['tipo'], $unArrayAsosiativo['stock'], $unArrayAsosiativo['precio']);
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

    public function EvaluarUnProducto()
    {
        $mensaje = "no se pudo hacer";

        if($this->AgragarStock())
        {
            $mensaje = "Actualizado";
            
        }else{

            if($this->AgregarUnProductoBD())
            {
                $mensaje = "Ingresado";
            }
        }
        
        
        return $mensaje;
    }

    public function BuscarUnProductoBD()
    {
        $estado = false;
        $unObjetoAccesoDato = AccesoDatos::ObtenerUnObjetoPdo();
        $consulta = null;
        if(isset($unObjetoAccesoDato))
        {
            $consulta = $unObjetoAccesoDato->RealizarConsulta("SELECT COUNT(*) as cantidadTotal FROM producto as p where p.codigoDeBarra  = :codigoDeBarra ");
            $consulta->bindValue(':codigoDeBarra',$this->codigoDeBarra,PDO::PARAM_STR);
            $consulta->execute();
            $arrayPdo = $consulta->fetch(PDO::FETCH_ASSOC);
            $estado = $arrayPdo['cantidadTotal'] > 0;
        }

        return  $estado;
    }

    private function AgragarStock()
    {
        $estado = false;

        if($this->BuscarUnProductoBD())
        {
            $this->stock++;
            $estado = $this->ModificarUnProductoBD();
        }

        return $estado;
    }

    public function ModificarUnProductoBD()
    {
        $estado = false;
        $unObjetoAccesoDato = AccesoDatos::ObtenerUnObjetoPdo();
        $consulta = null;
        if(isset($unObjetoAccesoDato))
        {
            $consulta = $unObjetoAccesoDato ->RealizarConsulta(
           "UPDATE producto SET 
           codigoDeBarra=:codigoDeBarra,
           nombre=:nombre,
           tipo=:tipo,
           stock=:stock,
           precio=:precio,
           fechaDeCreacion=:fechaDeCreacion,
           fechaDeModificacion=:fechaDeModificacion 
           WHERE ID=:id ");
            $consulta->bindValue(':id',self::$id,PDO::PARAM_INT);
            $consulta->bindValue(':nombre',$this->nombre,PDO::PARAM_STR);
            $consulta->bindValue(':codigoDeBarra',$this->codigoDeBarra,PDO::PARAM_STR);
            $consulta->bindValue(':tipo',$this->tipo,PDO::PARAM_STR);
            $consulta->bindValue(':stock',$this->stock,PDO::PARAM_INT);
            $consulta->bindValue(':precio',$this->precio);
            $consulta->bindValue(':fechaDeCreacion',self::$fechaDeCreacion);
            $consulta->bindValue(':fechaDeModificacion',self::$fechaDeModificacion);
            $estado = $consulta->execute();
        }

        return  $estado;
    }
    public function AgregarUnProductoBD()
    {
        $estado = false;
        $unObjetoAccesoDato = AccesoDatos::ObtenerUnObjetoPdo();
        $consulta = null;
        if(isset($unObjetoAccesoDato))
        {
            $consulta = $unObjetoAccesoDato ->RealizarConsulta(
           "INSERT INTO producto (nombre,codigoDeBarra,tipo,stock,precio,fechaDeCreacion,fechaDeModificacion) 
            VALUES (:nombre,:codigoDeBarra,:tipo,:stock,:precio,:fechaDeCreacion,:fechaDeModificacion) ");
            $consulta->bindValue(':nombre',$this->nombre,PDO::PARAM_STR);
            $consulta->bindValue(':codigoDeBarra',$this->codigoDeBarra,PDO::PARAM_STR);
            $consulta->bindValue(':tipo',$this->tipo,PDO::PARAM_STR);
            $consulta->bindValue(':stock',$this->stock,PDO::PARAM_INT);
            $consulta->bindValue(':precio',$this->precio);
            $consulta->bindValue(':fechaDeCreacion',self::$fechaDeCreacion);
            $consulta->bindValue(':fechaDeModificacion',self::$fechaDeModificacion);
            $estado = $consulta->execute();
        }

        return  $estado;
    }


    // public static function EscribirArrayPorJson($listaDeUsuario,$nombreDeArchivo)
    // {
    //     $estado = false;
    //     $unArchivo = fopen($nombreDeArchivo,"w");

    //     if(isset($unArchivo) && isset($listaDeUsuario) && count($listaDeUsuario) > 0 &&
    //     ($listaStr = Producto::SerializarArrayDeProductoJson($listaDeUsuario)) !== null)
    //     {
    //         $estado = fwrite($unArchivo ,json_encode($listaStr));
    //         fclose($unArchivo);
    //     }

    //     return $estado;
    // }

    // private static function SerializarArrayDeProductoJson($listaDeProductos)
    // {
    //     $listaDeArrayAsosiativo = null;

    //     if( isset($listaDeProductos))
    //     {
    //         $listaDeArrayAsosiativo = [];

    //         foreach ($listaDeProductos as $unProducto)
    //         {
    //             array_push($listaDeArrayAsosiativo, $unProducto->ObternerDatos());
    //         }
    //     }

    //     return $listaDeArrayAsosiativo;
    // }

    // // private static $id;
    // private $codigoDeBarra;
    // private $nombre;
    // private $tipo;
    // private $stock;
    // private $precio;
    // private $fechaDeCreacion;
    // // private $fechaDeModificacion;
    // private function ObternerDatos() 
    // {
    //     return array(
    //         'id' => self::$id,
    //         'codigoDeBarra' => $this->codigoDeBarra,
    //         'nombre' => $this->nombre,
    //         'tipo' => $this->tipo,
    //         'stock' => $this->stock,
    //         'precio' => $this->precio,
    //         'fechaDeCreacion' => self::$fechaDeCreacion,
    //         'fechaDeModificacion' => self::$fechaDeModificacion
    //     );
    // }

    // public function SerializarUnProductoEnJson()
    // {
    //     return json_encode($this->ObternerDatos());
    // }

    

}
?>