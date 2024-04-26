<!-- Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado, Retorna
un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario. -->

<?php

class Usuario{
    
    private $mail;
    private $clave;
   

    public function __construct($mail,$clave) {
        
        $this->mail = $mail;
        $this->clave = $clave;
    }

    public static function BuscarPorMail($listaDeUsuarios,$mail)
    {
        $unUsuario = null;

        if(isset($mail) && isset($listaDeUsuarios))
        {
            foreach($listaDeUsuarios as $unUsuarioDeLaLista)
            {
                if(strcmp($unUsuarioDeLaLista->mail,$mail) == 0 )
                {
                    $unUsuario = $unUsuarioDeLaLista;
                    break;
                }
            }
        }

        return $unUsuario;
    }

    public function VerificarClave($clave)
    {
        $estado = false;
        
        if(isset($clave))  
        {
            $estado = strcmp($this->clave,$clave) == 0;
        }
     
        return $estado;
    }

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