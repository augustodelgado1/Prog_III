<!-- 

Alumno : Augusto Delgado 
Div : A332
-->

<!-- Aplicación No 26 (RealizarVenta)
Archivo: RealizarVenta.php
método:POST
Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
POST .
Verificar que el usuario y el producto exista y tenga stock.
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). carga
los datos necesarios para guardar la venta en un nuevo renglón.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesaris en las clases
-->


<?php

require_once "Usuario.php";

class Venta{
    static private $id;
    static private $idProducto;
    private $idDeUsuario;
    private $cantidad;
    private static $fechaDeVenta;
   

    public function __construct($idDeUsuario,$idProducto,$cantidad) 
    {
        self::$id = Venta::CrearIdAutoIncremental();
        $this->idDeUsuario = $idDeUsuario;
        $this->idProducto = $idProducto;
        $this->cantidad = $cantidad;
        self::$fechaDeVenta = date("Y-m-d");
    }

    private static function CrearIdAutoIncremental()
    {
        return  rand(1,10000);
    }

    public static function ObtenerListaDeVentasBD()
    {
        $listaDeVentas = null;
        $unObjetoAccesoDato = AccesoDatos::ObtenerUnObjetoPdo();
        $consulta = null;
        if(isset($unObjetoAccesoDato))
        {
            $consulta = $unObjetoAccesoDato->RealizarConsulta("SELECT * FROM venta");
            $estado = $consulta->execute();
            $listaDeVentas = $consulta->fetchAll();
            $listaDeUsuarios = $consulta->fetchAll(Pdo::FETCH_CLASS,__CLASS__,array('idDeUsuario','idProducto','cantidad'));
        }

        return  $listaDeVentas;
    }





    // public static function EscribirArrayPorJson($listaDeVentas,$nombreDeArchivo)
    // {
    //     $estado = false;
    //     $unArchivo = fopen($nombreDeArchivo,"w");

    //     if(isset($unArchivo) && isset($listaDeVentas) &&
    //     ($listaDeArrayAsosiativo = Venta::SerializarArrayDeVentasJson($listaDeVentas)) !== null)
    //     {
    //         $estado = fwrite($unArchivo ,json_encode($listaDeArrayAsosiativo));
    //         fclose($unArchivo);
    //     }

    //     return $estado;
    // }

    // private static function SerializarArrayDeVentasJson($listaDeVentas)
    // {
    //     $listaDeArrayAsosiativo = null;

    //     if( isset($listaDeVentas))
    //     {
    //         $listaDeArrayAsosiativo = [];

    //         foreach ($listaDeVentas as $unVenta)
    //         {
    //             array_push($listaDeArrayAsosiativo, $unVenta->ObternerDatos());
    //         }
    //     }

    //     return $listaDeArrayAsosiativo;
    // }
   
    // private function ObternerDatos() 
    // {
    //     return array(
    //         'id' => self::$id,
    //         'Producto' => $this->idProducto,
    //         'Usuario' => $this->idDeUsuario,
    //         'listaDeProductos' => $this->cantidad,
    //         'fecha De Venta' => $this->cantidad,
    //     );
    // }
   

   
    
   

  






}



?>