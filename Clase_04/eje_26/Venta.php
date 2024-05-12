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
    static private $fechaDeVenta;
    private $idDeUsuario;
    private $listaDeProductos;
   

    public function __construct($idDeUsuario) 
    {
        self::$id = Venta::CrearIdAutoIncremental();
        $this->idDeUsuario = $idDeUsuario;
        self::$fechaDeVenta = date("Y-m-d H:i:s");
    }

    private static function CrearIdAutoIncremental()
    {
        return  rand(1,10000);
    }

    
    
    public function AddProducto($unCodigoDeBarra,$cantidadDeItem)
    {
        $estado = false;

        if(isset($unCodigoDeBarra) && $cantidadDeItem > 0)
        {
            $this->listaDeProductos[$unCodigoDeBarra] = $cantidadDeItem;
            $estado = true;
        }

        return  $estado;
    }

    public static function EscribirUnArrayDeVentaPorJson($listaDeVentas,$nombreDeArchivo)
    {
        $estado = false;
        $unArchivo = fopen($nombreDeArchivo,"w");

        if(isset($unArchivo) && isset($listaDeVentas) &&
        ($listaDeArrayAsosiativo = Venta::SerializarArrayDeVentasJson($listaDeVentas)) !== null)
        {
            $estado = fwrite($unArchivo ,json_encode($listaDeArrayAsosiativo));
            fclose($unArchivo);
        }

        return $estado;
    }

    private static function SerializarArrayDeVentasJson($listaDeVentas)
    {
        $listaDeArrayAsosiativo = null;

        if( isset($listaDeVentas))
        {
            $listaDeArrayAsosiativo = [];

            foreach ($listaDeVentas as $unVenta)
            {
                array_push($listaDeArrayAsosiativo, $unVenta->ObternerDatos());
            }
        }

        return $listaDeArrayAsosiativo;
    }

    private function ObternerDatos() {
        return array(
            'id' => self::$id,
            'idDeUsuario' => $this->idDeUsuario,
            'fechaDeVenta' => self::$fechaDeVenta,
            'listaDeProductos' => $this->listaDeProductos
        );
    }
   
 
    

    // public static function AgregarUnUsuarioPorCsv($unUsuario,$nombreDeArchivo)
    // {
    //     $estado = false;
    //     $unArchivo = fopen($nombreDeArchivo,"a+");

    //     if(isset($unArchivo) && isset( $unUsuario)){

    //         $estado = fputcsv($unArchivo,array($unUsuario->_mail,$unUsuario->_nombre,$unUsuario->_clave));
    //         fclose($unArchivo);
    //     }

    //     return $estado;
    // }

   

  


    // public static function BuscarPorMail($listaDeUsuarios,$mail)
    // {
    //     $unUsuario = null;

    //     if(isset($mail) && isset($listaDeUsuarios))
    //     {
    //         foreach($listaDeUsuarios as $unUsuarioDeLaLista)
    //         {
    //             if(strcmp($unUsuarioDeLaLista->mail,$mail) == 0 )
    //             {
    //                 $unUsuario = $unUsuarioDeLaLista;
    //                 break;
    //             }
    //         }
    //     }

    //     return $unUsuario;
    // }

    // public function VerificarClave($clave)
    // {
    //     $estado = false;
        
    //     if(isset($clave))  
    //     {
    //         $estado = strcmp($this->clave,$clave) == 0;
    //     }
     
    //     return $estado;
    // }

    // public function ToString() {

    //     return "<br> Email : $this->email
    //             <br> Clave : $this->clave";

    // }

   

    // public function User_exist($mail,$clave) 
    // {
    //     $estado = false;
        
    //     if(isset($mail) && isset($clave))  
    //     {
    //         $estado = strcmp($this->mail,$mail) == 0 && strcmp($this->clave,$clave) == 0;
    //     }
     
    //     return $estado;
    // }

    

    // public static function BuscarUnUsuario($listaDeUsuarios,$mail,$clave)
    // {
    //     $unUsuario  = null;

    //     if(isset($mail) && isset($clave) && isset($listaDeUsuarios))
    //     {
    //         foreach($listaDeUsuarios as $unUsuarioDeLaLista)
    //         {
    //             if($$unUsuarioDeLaLista->User_exist($mail,$clave))
    //             {
    //                 $unUsuario = $unUsuarioDeLaLista;
    //                 break;
    //             }
    //         }
    //     }

    //     return $unUsuario ;
    // }


   

   

    // public function Equals($UnUsuario) 
    // {
    //     $estado = false;
        
    //     if(isset($UnUsuario->email) && isset($UnUsuario->clave))  
    //     {
    //         $estado = strcmp($this->email,$UnUsuario->email) == 0 && strcmp($this->clave,$UnUsuario->clave) == 0;
    //     }

    //     return $estado;
    // }




}



?>