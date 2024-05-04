<!-- 

Alumno : Augusto Delgado 
Div : A332
-->

<!-- Aplicación No 24 ( Listado JSON y array de usuarios)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,etc.),por ahora solo tenemos
usuarios).
En el caso de usuarios carga los datos del archivo usuarios.json.
se deben cargar los datos en un array de usuarios.
Retorna los datos que contiene ese array en una lista.
Hacer los métodos necesarios en la clase usuario-->


<?php

require_once "File.php";

class Usuario{
    static private $id;
    static private $fechaDeRegistro;
    private $_mail;
    private $_clave;
    private $_nombre;
    
   

    public function __construct($nombre,$mail,$clave) {
        
        self::$id = Usuario::CrearIdAutoIncremental();
        $this->_mail = $mail;
        $this->_nombre = $nombre;
        $this->_clave = $clave;
        self::$fechaDeRegistro = date("Y-m-d H:i:s");
    }

    public static function CrearUsuario($nombre,$mail,$clave) 
    {
        $unUsuario = null;
        
        if(isset($clave) && isset($nombre) && isset($mail))
        {
            $unUsuario =  new Usuario($nombre,$mail,$clave);
        }

        return $unUsuario;
    }
    public function MoverFoto($tmpNombre,$rutaASubir,$nombreDeArchivo)
    {
        $estado = false;

        if(isset($tmpNombre) && isset($rutaASubir))
        {
            $rutaDestino = $rutaASubir .$this->_nombre. time(). $nombreDeArchivo;
            $estado =  move_uploaded_file($tmpNombre,$rutaDestino);
        }

        return $estado;
    }
// static private $id;
    // static private $fechaDeRegistro;
    // private $_mail;
    // private $_clave;
    // private $_nombre;
    private function ObternerDatos() {
        return array(
            'id' => self::$id,
            '_nombre' => $this->_nombre,
            '_clave' => $this->_clave,
            '_mail' => $this->_mail,
            'fechaDeRegistro' => self::$fechaDeRegistro
        );
    }

    private static function CrearIdAutoIncremental()
    {
       
        return  rand(1,10.000);
    }

    private static function SerializarArrayDeUsuarioJson($listaDeUsuario)
    {
        $listaStr = null;

        if( isset($listaDeUsuario))
        {
            $listaStr = [];

            foreach ($listaDeUsuario as $unUsuario)
            {
                array_push($listaStr, $unUsuario->ObternerDatos() );
            }
        }

        return $listaStr;
    }
    public static function EscribirArrayPorJson($listaDeUsuario,$nombreDeArchivo)
    {
        $estado = false;
        $unArchivo = fopen($nombreDeArchivo,"w");

        if(isset($unArchivo) && isset($listaDeUsuario) && count($listaDeUsuario) > 0 &&
        ($listaStr = Usuario::SerializarArrayDeUsuarioJson($listaDeUsuario)) !== null)
        {
            $estado = fwrite($unArchivo ,json_encode($listaStr));
            fclose($unArchivo);
        }

        return $estado;
    }
    public function ToString()
    {
        return "Nombre :".$this->_nombre.PHP_EOL."Mail:".$this->_mail.PHP_EOL;
    }

    public static function MostrarListaDeUsuarioEnHtml($listaDeUsuarios)
    {
        $strListahtml = null;

        if(isset($listaDeUsuarios) && count($listaDeUsuarios) > 0)
        {
            $strListahtml = "<ul>";

            foreach ($listaDeUsuarios as $unUsuario)
            {
                $strListahtml .= "<li>".$unUsuario->ToString()."</li>";
            }

            $strListahtml .= "<ul>";
        }

        return $strListahtml;
    }

    public static function LeerJson($nombreDeArchivo,$boolArrayAsosiativo = false)
    {
        $unArchivo = fopen($nombreDeArchivo,"r");
        $listaDeUsuarios = null;
        $unaLinea = null;

        if(isset($unArchivo)){

            $listaDeUsuarios = [];
            $unaLinea = fgets($unArchivo);
            $listaDeArrayAsosiativos =  json_decode($unaLinea,$boolArrayAsosiativo);
            $listaDeUsuarios = Usuario::DeserializarUnaListaEnJson($listaDeArrayAsosiativos);
            fclose($unArchivo);
        }

        return $listaDeUsuarios;
    }

    private static function DeserializarUnaListaEnJson($listaDeArraysAsosiativo)
    {
        $listaDeUsuarios = null;

        if( isset($listaDeArraysAsosiativo) && count( $listaDeArraysAsosiativo ) > 0)
        {
            $listaDeUsuarios = [];

            foreach ($listaDeArraysAsosiativo as $unArrayAsosiativo)
            {
                if(($unUsuario = Usuario::DeseralizarPorJsonUnUsuario($unArrayAsosiativo)) !== null)
                {
                    array_push($listaDeUsuarios, $unUsuario);
                }
            }
        }

        return $listaDeUsuarios;
    }

    
    private static function DeseralizarPorJsonUnUsuario($unArrayAsosiativo)
    {
        $unUsuario = null;

        if(Usuario::ValidarKeys($unArrayAsosiativo) == true)
        {
            // echo "entro";
            $unUsuario = new Usuario($unArrayAsosiativo['_nombre'],$unArrayAsosiativo['_mail'],$unArrayAsosiativo['_clave']);
            $unUsuario::$id = $unArrayAsosiativo['id'];
            $unUsuario::$fechaDeRegistro = $unArrayAsosiativo['fechaDeRegistro'];
        }
        
        return $unUsuario;
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
                    // echo'Es esta '. $key ;
                    break;
                }
            }
        }

        return $estado;
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