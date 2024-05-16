

<?php


class Usuario
{
    private $id;
    private $nombre;
    private $clave;
    private $mail;
    private $fechaDeRegistro;

    public function __construct($mail,$clave,$nombre) {
        $this->nombre = $nombre;
        $this->mail = $mail;
        $this->clave = $clave;
        $this->fechaDeRegistro = date("Y-m-d");
        $this->id = Usuario::ObtenerIdAutoIncremental();
    }

    private static function ObtenerIdAutoIncremental()
    {
        return rand(1,10000);
    }

    public static function CompararPorNombre($unUsuario,$otroUsuario)
    {
        $retorno = 0;
        $comparacion = strcmp($unUsuario->nombre,$otroUsuario->nombre);

        if( $comparacion  > 0)
        {
            $retorno = 1;
        }else{

            if( $comparacion < 0)
            {
                $retorno = -1;
            }
        }

        return $retorno ;
    }

    public static function BuscarUsuarioPorId($listaDeUsuario,$id)
    {
        $unaUsuarioABuscar = null; 

        if(isset($listaDeUsuario) )
        {
            foreach($listaDeUsuario as $unaUsuario)
            {
                if($unaUsuario->id == $id)
                {
                    $unaUsuarioABuscar = $unaUsuario; 
                    break;
                }
            }
        }

        return  $unaUsuarioABuscar;
    }

   
}


?>