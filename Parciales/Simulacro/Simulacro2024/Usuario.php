

<?php


class Usuario
{
    private static $id;
    private $nombre;
    private $clave;
    private $mail;
    private static $fechaDeRegistro;
    private $cuponDeDescuento;


    public function __construct($mail,$clave,$nombre,$cuponDeDescuento = null) {
        $this->nombre = $nombre;
        $this->mail = $mail;
        $this->clave = $clave;
        $this->cuponDeDescuento = $cuponDeDescuento;
        self::$fechaDeRegistro = date("Y-m-d");
        self::$id = Usuario::ObtenerIdAutoIncremental();
    }

    private static function ObtenerIdAutoIncremental()
    {
        return rand(1,10000);
    }

    public function GenerarCuponDeDescuento($devolucion_id,$porcentajeDeDescuento)
    {
        $estado = false;
        if(isset($devolucion_id) && isset($porcentajeDeDescuento))
        {
            $this->cuponDeDescuento =  new CuponDescuento($devolucion_id,$porcentajeDeDescuento);
            $estado = true;
        }
       
        return   $estado ;
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
                if($unaUsuario::$id == $id)
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