<!-- 

Alumno : Augusto Delgado 
Div : A332
-->

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

    

    public static function EscribirArrayPorCsv($listaDeUsuario,$nombreDeArchivo)
    {
        $estado = false;
        $unArchivo = fopen($nombreDeArchivo,"w");

        if(isset($unArchivo) && isset( $listaDeUsuario) && count($listaDeUsuario) > 0){
            
            $estado = true;
            
            foreach( $listaDeUsuario as $UnUsuario ){

                if(!fputcsv($unArchivo,array($UnUsuario->_mail,$UnUsuario->_nombre,$UnUsuario->_clave)))
                {
                    $estado = false;
                    break;
                }
            }

           
            fclose($unArchivo);
        }

        return $estado;
    }

    public static function LeerCsv($nombreDeArchivo)
    {
        $listaDeUsuarios  = null;
        $unArchivo = fopen($nombreDeArchivo,"r");

        if(isset($unArchivo)){

            $listaDeUsuarios = [];
    
            while(($strUsuario = fgetcsv($unArchivo)) !== false){

                if(isset($strUsuario ) && 
                ($unUsuario = Usuario::AltaDeUsuario($strUsuario[0],$strUsuario[1],$strUsuario[2])) !== null)
                {
                    array_push($listaDeUsuarios, $unUsuario);    
                }
            }

            fclose($unArchivo);
        }

        return   $listaDeUsuarios ;
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

    public static function AltaDeUsuario($nombre,$mail,$clave) 
    {
        $unUsuario = null;

        if(isset($clave) && isset($nombre) && isset($mail))
        {
            $unUsuario = new Usuario($nombre, $mail, $clave);
        }
       

        return $unUsuario;
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