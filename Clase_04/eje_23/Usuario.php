<!-- 

Alumno : Augusto Delgado 
Div : A332
-->

<!-- Aplicación No 23 (Registro JSON)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un dato con la
fecha de registro , toma todos los datos y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
Usuario/Fotos/.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario. -->


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

    public static function AltaDeUsuarioPorJson($unUsuario,$nombreDeArchivo)
    {
        $estado = false;
        $unArchivo = fopen($nombreDeArchivo,"a+");

        if(isset($unArchivo) && isset( $unUsuario)){

            $estado = fwrite( $unArchivo ,json_encode($unUsuario->ObternerDatos()));
            fclose($unArchivo);
        }

        return $estado;
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

    private function ObternerDatos() {
        return array(
            'id' => self::$id,
            'nombre' => $this->_nombre,
            'clave' => $this->_clave,
            'mail' => $this->_mail,
            'fecha_registro' => self::$fechaDeRegistro
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

        if(isset($listaDeUsuarios))
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