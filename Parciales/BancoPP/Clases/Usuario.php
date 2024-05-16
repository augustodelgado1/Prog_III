
<!-- 

//            B- CuentaAlta.php: (por POST) se ingresa Nombre y ApellnumeroDeCuentao, Tipo Documento, Nro.
// Documento, Email, Tipo de Cuenta (CA – caja de ahorro o CC – cuenta corriente),
// Moneda ($ o U$S), Saldo Inicial (0 por defecto).
// NOTA: los números de cuenta son únicos dentro del Banco, consnumeroDeCuentaerando para
// evaluarlos que la cuenta está compuesta por tipo de cuenta (CA o CC), nro. de cuenta y
// moneda.
// Se guardan los datos en el archivo banco.json, tomando un numeroDeCuenta autoincremental de 6
// dígitos como Nro. de Cuenta (emulado). Sí el número y tipo ya existen, se actualiza el
// saldo existente.
// completar el alta con imagen/foto del usuario/cliente, guardando la imagen con Nro y
// Tipo de Cuenta (ej.: NNNNNNTT) como numeroDeCuentaentificación en la carpeta:
// /ImagenesDeCuentas/2023. -->
<?php

require_once 'Clases/File.php';
class Usuario
{
    private $numeroDeCuenta;
    private $nombre;
    private $apellido; 
    private $clave;
    private $mail;
    private $numeroDeDocumento;
    private $tipoDeCuenta;
    private $moneda;
    private $saldo;
    private $nombreDeLaImagen;
    private $rutaDeLaImagen;

    public function __construct($mail,$clave,$nombre,$apellido,$numeroDeDocumento,$tipoDeCuenta,$moneda,$rutaDeLaImagen = null,$nombreDeLaImagen = null,) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->mail = $mail;
        $this->clave = $clave;
        $this->numeroDeDocumento = $numeroDeDocumento;
        $this->tipoDeCuenta = $tipoDeCuenta;
        $this->moneda = $moneda;
        $this->SetImagen($rutaDeLaImagen,$nombreDeLaImagen);
        $this->numeroDeCuenta = Usuario::ObtenerNumeroDeCuentaAutoIncremental();
        $this->saldo = 0;
    }

    public function GetTipoDeCuenta()
    {
        return  $this->tipoDeCuenta;
    }

    public function GetNumeroDeCuenta()
    {
        return  $this->numeroDeCuenta;
    }


    public function ActualizarSaldo($saldo)
    {
        $estado = false;
        if(isset($saldo) && $saldo > 0 )
        {
            $this->saldo = $saldo ;
            $estado = true;
        }

        return $estado;
    }

    public function GetSaldo()
    {
        return  $this->saldo;
    }

    public function SetImagen($ruta,$nombreDelaImagen)
    {
        $estado = false;
        if(isset($ruta) && isset($nombreDelaImagen))
        {
            $this->nombreDeLaImagen = $this->numeroDeCuenta.$this->tipoDeCuenta.$nombreDelaImagen;
            $this->rutaDeLaImagen = $ruta;
            $estado = true;
        }

        return $estado;
    }

    public function MostrarSaldo()
    {
        return "moneda: ". $this->moneda. $this->saldo.'<br>';
    }

    public function MoverImagen($nuevaRuta)
    {
        $estado = false;
        if(File::MoverFoto($this->rutaDeLaImagen,$nuevaRuta,$this->nombreDeLaImagen))
        {
            $this->rutaDeLaImagen = $nuevaRuta;
            $estado = true;
        }

        return $estado;
    }

    private static function ObtenerNumeroDeCuentaAutoIncremental()
    {
        return rand(99999,1000000);
    }

    public static function EscribirUsuarioEnArrayJson($listaDeUsuarios,$nombreDeArchivo)
    {
        $estado = false; 
        $listaDeArrayAsosiativos = null;

        if(isset($listaDeUsuarios) 
        && ($listaDeArrayAsosiativos = Usuario::SerializarListaJson($listaDeUsuarios)) !== null)
        {
            $estado =  File::EscribirEnArrayJson($listaDeArrayAsosiativos,$nombreDeArchivo);
        }
        return  $estado;
    }

    private static function SerializarListaJson($listaDeUsuarios)
    {
        $listaDeArrayAsosiativos = null; 

        if(isset($listaDeUsuarios))
        {
            $listaDeArrayAsosiativos = [];

            foreach($listaDeUsuarios as $unUsuario)
            {
                array_push($listaDeArrayAsosiativos,$unUsuario->ObtenerDatos());
            }
        }

        return  $listaDeArrayAsosiativos ;
    }

        // private $numeroDeCuenta;
        // private $nombre;
        // private $apellido; 
        // private $clave;
        // private $mail;
        // private $numeroDeDocumento;
        // private $tipoDeCuenta;
        // private $moneda;
        // private $saldo;
        // private $nombreDeLaImagen;
        // private $rutaDeLaImagen;
  
    public static function LeerJson($nombreDeArchivo)
    {
        return Usuario::DeserializarListaJson(File::LeerListaJson($nombreDeArchivo,true));
    }

    private static function DeserializarListaJson($listaDeArrayAsosiativos)
    {
        $listaDeUsuarios = null; 

       
        if(isset($listaDeArrayAsosiativos))
        {
            $listaDeUsuarios = [];
         
            foreach($listaDeArrayAsosiativos as $unArrayAsosiativo)
            {
                $unUsuario = Usuario::ObtenerUnaUsuarioPorArrayAsosiativo($unArrayAsosiativo);
                if(isset($unUsuario))
                {
                    array_push($listaDeUsuarios,$unUsuario);
                }
            }
        }

      

        return  $listaDeUsuarios ;
    }

    public static function ObtenerUnaUsuarioPorArrayAsosiativo($unArrayAsosiativo)
    {
        $unaUsuario = null;

    
        if(isset($unArrayAsosiativo) && isset($unArrayAsosiativo["mail"])
        && isset($unArrayAsosiativo["nombre"]) && isset($unArrayAsosiativo["clave"])
        && isset($unArrayAsosiativo["apellido"]) && isset($unArrayAsosiativo["numeroDeDocumento"])
        && isset($unArrayAsosiativo["moneda"]) && isset($unArrayAsosiativo["tipoDeCuenta"]))
        {
            $unaUsuario = new Usuario($unArrayAsosiativo["mail"],
            $unArrayAsosiativo["clave"],$unArrayAsosiativo["nombre"],
            $unArrayAsosiativo["apellido"], $unArrayAsosiativo["numeroDeDocumento"], $unArrayAsosiativo["tipoDeCuenta"], 
            $unArrayAsosiativo["moneda"], $unArrayAsosiativo["rutaDeLaImagen"],$unArrayAsosiativo["nombreDeLaImagen"]);
            $unaUsuario->SetNumeroDeCuenta( $unArrayAsosiativo['numeroDeCuenta']);
            $unaUsuario->ActualizarSaldo($unArrayAsosiativo['saldo']);
        }
        
        return $unaUsuario;
    }

    // // [{"nombre":"mercedes",
    //     "apellido":"bens","clave":"12345678","mail":"dkantor0@example.com","numeroDeCuenta":"638082","numeroDeDocumento":"12345678","tipoDeCuenta":"CC","moneda":null,"saldo":0,"nombreDeLaImagen":"638082CChelado.jpg","rutaDeLaImagen":"imagen\/usuario"}]

    private function ObtenerDatos()
    {
        return array(
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'clave' => $this->clave,
            'mail' => $this->mail,
            'numeroDeCuenta' => $this->numeroDeCuenta,
            'numeroDeDocumento' => $this->numeroDeDocumento,
            'tipoDeCuenta' => $this->tipoDeCuenta,
            'moneda' => $this->moneda,
            'saldo' => $this->saldo,
            'nombreDeLaImagen' => $this->nombreDeLaImagen,
            'rutaDeLaImagen' => $this->rutaDeLaImagen,
        );
    }
   



    private function SetNumeroDeCuenta($numeroDeCuenta)
    {
        $estado = false;
        if(isset($numeroDeCuenta))
        {
            $this->numeroDeCuenta = $numeroDeCuenta;
            $estado = true;
        }

        return  $estado ;
    }

    // public static function BuscarUnaUsuarioPorNumeroDePednumeroDeCuentao($listaDeUsuarios,$numeroDeCuenta)
    // {
    //     $index = -1;
    //     $leght = count($listaDeUsuarios); 
    //     if(isset($listaDeUsuarios)  && $leght > 0)
    //     {
    //         for ($i=0; $i < $leght; $i++) { 
         
    //             if( $listaDeUsuarios[$i]->numeroDeCuenta == $numeroDeCuenta)
    //             {
    //                 $index = $i;
     
    //                 break;
    //             }
    //         }
    //     }

    //     return $index;
    // }

    public static function BuscarUsuarioPorNumeroDeCuenta($listaDeUsuario,$numeroDeCuenta)
    {
        $unaUsuarioABuscar = null; 

        if(isset($listaDeUsuario) && isset($numeroDeCuenta))
        {
            foreach($listaDeUsuario as $unaUsuario)
            {
                if($unaUsuario->numeroDeCuenta == $numeroDeCuenta)
                {
                    $unaUsuarioABuscar = $unaUsuario; 
                    break;
                }
            }
        }

        return  $unaUsuarioABuscar;
    }

    public function ToString()
    {
        return "nombre: ".$this->nombre.'<br>'
        ."apellido: ".$this->apellido.'<br>'
        ."mail: ".$this->mail.'<br>'
        ."clave: ".$this->clave.'<br>'
        ."numeroDeDocumento: ".$this->numeroDeDocumento.'<br>' 
        ."numeroDeCuenta: ". $this->numeroDeCuenta.'<br>'
        ."tipoDeCuenta: ". $this->tipoDeCuenta.'<br>'.
        $this->MostrarSaldo()
        ."nombreDeLaImagen: ". $this->nombreDeLaImagen.'<br>'
        ."rutaDeLaImagen: ". $this->rutaDeLaImagen;
    }


    // public static function ToStringList($listaDeUsuario)
    // {
    //     $strLista = null; 

    //     if(isset($listaDeUsuario) )
    //     {
    //         foreach($listaDeUsuario as $unaUsuario)
    //         {
    //             $strLista = $unaUsuario->ToString().'<br>';
    //         }
    //     }

    //     return   $strLista;
    // }
}


?>