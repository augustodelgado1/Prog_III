<!-- Aplicación No 20 BIS (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario -->

<?php

class Usuario{
    
    private $_mail;
    private $_clave;
    private $_nombre;
   

    public function __construct($nombre,$mail,$clave) {
        
        $this->_mail = $mail;
        $this->_nombre = $nombre;
        $this->_clave = $clave;
    }

    public static function AltaDeUsuario($nombre,$mail,$clave) 
    {
        $unUsuario = null;

        if(Usuario::ValidarNombre($nombre) !== false 
        && Usuario::ValidarMail($mail) !== false 
        && Usuario::ValidarClave($clave) !== false)
        {
            $unUsuario = new Usuario($nombre, $mail, $clave);
        }
       

        return $unUsuario;
    }

    private static function ValidarClave($clave)
    {
        return isset($clave) && strlen($clave) >= 8;
    }
    
    private static function ValidarMail($mail)
    {
        return isset($mail) && strlen($mail) >= 10;
    }
    

    private static function ValidarNombre($nombre)
    {
        return isset($nombre) ;
    }
    

    public static function EscribirUnUsuarioPorCsv($unUsuario,$nombreDeArchivo)
    {
        $estado = false;
        $unArchivo = fopen($nombreDeArchivo,"a+");

        if(isset($unArchivo) && isset( $unUsuario)){

            $estado = fputcsv($unArchivo,array($unUsuario->_mail,$unUsuario->_nombre,$unUsuario->_clave));
            fclose($unArchivo);
        }

        return $estado;
    }

    // public static function EscribirArrayPorCsv($listaDeUsuario,$nombreDeArchivo)
    // {
    //     $estado = false;
    //     $unArchivo = fopen($nombreDeArchivo,"w");

    //     if(isset($unArchivo) && isset( $listaDeUsuario)){
            
    //         $estado = true;
            
    //         foreach( $listaDeUsuario as $UnUsuario ){

    //             if(!fputcsv($unArchivo,array($UnUsuario->_mail,$UnUsuario->_nombre,$UnUsuario->_clave)))
    //             {
    //                 $estado = false;
    //                 break;
    //             }
    //         }

           
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