

<?php

require_once 'Clases/Usuario.php';
class Deposito
{
    private $id;
    private $unUsuario;
    private $importe; 
    private $fechaDelDeposito;
    private $rutaDeLaImagen;
    private $nombreDeLaImagen;

    

    public function __construct($unUsuario,$importe,$ruta = null,$nombreDelaImagen = null) 
    {
        $this->unUsuario = $unUsuario;
        $this->importe = $importe;
        $this->fechaDelDeposito = date("Y-m-d");
        $this->id = Deposito::ObtenerIdAutoIncremental();
        $this->SetImagen($ruta,$nombreDelaImagen);
    }

//     b- Completar el depósito con imagen del talón de depósito con el nombre: Tipo de
// Cuenta, Nro. de Cuenta e Id de Depósito, guardando la imagen en la carpeta
// /ImagenesDeDepositos2023.
    private function SetImagen($ruta,$nombreDelaImagen)
    {
        $estado = false;
        if(isset($ruta) && isset($nombreDelaImagen))
        {
            $this->nombreDeLaImagen = $nombreDelaImagen;
            $this->rutaDeLaImagen = $ruta;
            $estado = true;
        }

        return $estado;
    }

    public function GuardarImagen($tmpNombre,$rutaASubir,$nombreDeArchivo)
    {
        $estado = false;
        
        $nombreAGuardar = $this->unUsuario->GetNumeroDeCuenta().$this->unUsuario->GetTipoDeCuenta().$this->id.$nombreDeArchivo;
        if(File::MoverArchivoSubido($tmpNombre,$rutaASubir,$nombreAGuardar))
        {
            $this->SetImagen($rutaASubir,$nombreAGuardar);
            $estado = true;
        }

        return $estado;
    }

    public function CambiarRutaDeLaImagen($nuevaRuta)
    {
        $estado = false;

        if(rename($this->rutaDeLaImagen.$this->nombreDeLaImagen,$nuevaRuta.$this->nombreDeLaImagen))
        {
            $this->rutaDeLaImagen = $nuevaRuta;
            $estado = true;
        }

        return $estado;
    }

    public function GetImporte()
    {
        return  $this->importe;
    }

    public function ActualizarImporte($importe)
    {
        $estado = false;

        if(isset($importe) && $importe > 0)
        {
            $this->unUsuario->ActualizarSaldo($this->unUsuario->getSaldo() + $importe);
            $estado = true;
        }

        return $estado;
    }

    private static function ObtenerIdAutoIncremental()
    {
        return rand(1,10000);
    }

    public static function EscribirDepositoEnArrayJson($listaDeDeposito,$numeroDeCuentaDeArchivo)
    {
        $estado = false; 
        $listaDeArrayAsosiativos = null;

        if(isset($listaDeDeposito) 
        && ($listaDeArrayAsosiativos = Deposito::SerializarListaJson($listaDeDeposito)) !== null)
        {
            $estado =  File::EscribirEnArrayJson($listaDeArrayAsosiativos,$numeroDeCuentaDeArchivo);
        }
        return  $estado;
    }

    private static function SerializarListaJson($listaDeDeposito)
    {
        $listaDeArrayAsosiativos = null; 

        if(isset($listaDeDeposito))
        {
            $listaDeArrayAsosiativos = [];

            foreach($listaDeDeposito as $unDeposito)
            {
                array_push($listaDeArrayAsosiativos,$unDeposito->ObtenerDatos());
            }
        }

        return  $listaDeArrayAsosiativos ;
    }

    private function ObtenerDatos()
    {
        return array(
            'importe' => $this->importe,
            'id' => $this->id,
            'fechaDelDeposito' => $this->fechaDelDeposito,
            'rutaDeLaImagen' => $this->rutaDeLaImagen,
            'nombreDeLaImagen' => $this->nombreDeLaImagen,
            'unUsuario' => $this->unUsuario,
        );
    }
   
    public static function LeerJson($numeroDeCuentaDeArchivo)
    {
        return Deposito::DeserializarListaJson(File::LeerListaJson($numeroDeCuentaDeArchivo,true));
    }

    private static function DeserializarListaJson($listaDeArrayAsosiativos)
    {
        $listaDeDeposito = null; 

        if(isset($listaDeArrayAsosiativos))
        {
            $listaDeDeposito = [];

            foreach($listaDeArrayAsosiativos as $unArrayAsosiativo)
            {
                array_push($listaDeDeposito,Deposito::ObtenerUnDepositoPorArrayAsosiativo($unArrayAsosiativo));
            }
        }

        return  $listaDeDeposito ;
    }

    public static function ObtenerUnDepositoPorArrayAsosiativo($unArrayAsosiativo)
    {
        $unDeposito = null;
        $unUsuario = Usuario::DeserializarUnUsarioJson($unArrayAsosiativo['unUsuario']);

        if(isset($unArrayAsosiativo) && isset($unArrayAsosiativo['importe']) && isset($unUsuario))
        {
            $unDeposito = new Deposito($unUsuario,
            $unArrayAsosiativo['importe'],
            $unArrayAsosiativo['rutaDeLaImagen'],$unArrayAsosiativo['nombreDeLaImagen']);
            $unDeposito->SetId( $unArrayAsosiativo['id']);
            $unDeposito->SetFechaDelDeposito( $unArrayAsosiativo['fechaDelDeposito']);
        }
        
        return $unDeposito;
    }

    private function SetId($id)
    {
        $estado = false;
        if(isset($id))
        {
            $this->id = $id;
            $estado = true;
        }

        return  $estado ;
    }

    private function SetFechaDelDeposito($fechaDelDeposito)
    {
        $estado = false;
        if(isset($fechaDelDeposito))
        {
            $this->fechaDelDeposito = $fechaDelDeposito;
            $estado = true;
        }

        return  $estado ;
    }
    public static function BuscarUnaDepositoPorId($listaDeDeposito,$id)
    {
        $index = -1;
        $leght = count($listaDeDeposito); 
        if(isset($listaDeDeposito)  && $leght > 0  && isset($id))
        {
            for ($i=0; $i < $leght; $i++) { 
         
                if($listaDeDeposito[$i]->id == $id)
                {
                    $index = $i;
                    break;
                }
            }
        }

        return $index;
    }



    public static function BuscarDepositoPorId($listaDeDeposito,$id)
    {
        $unaDepositoABuscar = null; 

        if(isset($listaDeDeposito)  
        && isset($id) )
        {
            foreach($listaDeDeposito as $unaDeposito)
            {
                if($unaDeposito->id == $id)
                {
                    $unaDepositoABuscar = $unaDeposito; 
                    break;
                }
            }
        }

        return  $unaDepositoABuscar;
    }

    //             4- ConsultaMovimientos.php: (por GET)
// Datos a consultar:
// a- El total depositado (monto) por tipo de cuenta y moneda en un día en
// particular (se envía por parámetro), si no se pasa fecha, se muestran las del día
// anterior.
// b- El listado de depósitos para un usuario en particular.
// c- El listado de depósitos entre dos fechas ordenado por nombre.
// d- El listado de depósitos por tipo de cuenta.
// e- El listado de depósitos por moneda.
    public static function FiltrarPorUsuario($listaDeDepositos,$numeroDeCuenta)
    {
        $listaDeDepositosDeUnUsuario = null;

        if(isset($listaDeDepositos) && isset($numeroDeCuenta) && count($listaDeDepositos) > 0)
        {
            $listaDeDepositosDeUnUsuario =  [];

            foreach($listaDeDepositos as $unDeposito)
            {
                if($unDeposito->unUsuario->GetNumeroDeCuenta() == $numeroDeCuenta)
                {
                    array_push($listaDeDepositosDeUnUsuario,$unDeposito);
                }
            }
        }

        return  $listaDeDepositosDeUnUsuario;
    }
// d- El listado de depósitos por tipo de cuenta.
    public static function FiltrarPorTipoDeUsuario($listaDeDepositos,$tipoDeCuenta)
    {
        $listaDeDepositosDeUnTipo = null;

        if(isset($listaDeDepositos) && isset($tipoDeCuenta) && count($listaDeDepositos) > 0)
        {
            $listaDeDepositosDeUnTipo =  [];

            foreach($listaDeDepositos as $unDeposito)
            {
                if($unDeposito->unUsuario->GetTipoDeCuenta() == $tipoDeCuenta)
                {
                    array_push($listaDeDepositosDeUnTipo,$unDeposito);
                }
            }
        }

        return  $listaDeDepositosDeUnTipo;
    }

    // e- El listado de depósitos por moneda.
    public static function FiltrarPorTipoDeMoneda($listaDeDepositos,$tipoMoneda)
    {
        $listaDeDepositosDeUnaMoneda = null;

        if(isset($listaDeDepositos) && isset($tipoMoneda) && count($listaDeDepositos) > 0)
        {
            $listaDeDepositosDeUnaMoneda =  [];

            foreach($listaDeDepositos as $unDeposito)
            {
                var_dump($unDeposito->unUsuario->GetTipoMoneda());
                if($unDeposito->unUsuario->GetTipoMoneda() == $tipoMoneda)
                {
                    array_push($listaDeDepositosDeUnaMoneda,$unDeposito);
                }
            }
        }

        return  $listaDeDepositosDeUnaMoneda;
    }

    public static function FiltrarDesdeUnaFecha($listaDeDepositos,$fechaDesde,$fechaHasta)
    {
        $filtrarPorVenta = null;

        if(isset($listaDeDepositos) && isset($fechaDesde) && isset($fechaHasta) && count($listaDeDepositos) > 0)
        {
            $filtrarPorVenta =  [];
        
            foreach($listaDeDepositos as $unDeposito)
            {
                if($unDeposito->fechaDelDeposito >= $fechaDesde && $unDeposito->fechaDelDeposito <= $fechaHasta)
                {
                    array_push($filtrarPorVenta,$unDeposito);
                }
            }
        }

        return  $filtrarPorVenta;
    }

    


    public static function FiltrarPorFecha($listaDeDepositos,$fechaDelDeposito)
    {
        $listaDeFechaDeDeposito = null;

        if(isset($listaDeDepositos) && isset($fechaDelDeposito) && count($listaDeDepositos) > 0)
        {
            $listaDeFechaDeDeposito =  [];

            
            foreach($listaDeDepositos as $unDeposito)
            {
               
                if($unDeposito->fechaDelDeposito == $fechaDelDeposito)
                {
                    array_push($listaDeFechaDeDeposito,$unDeposito);
                }
            }
        }

        return  $listaDeFechaDeDeposito;
    }

    //Contar

    public static function ObtanerMontoTotalDepositado($listaDeDepositos)
    {
        $montoTotal = -1;

        if(isset($listaDeDepositos))
        {
            $montoTotal = 0;

            foreach($listaDeDepositos as $unaDeposito)
            {
                $montoTotal += $unaDeposito->importe;
            }
        }

        return  $montoTotal;
    }

    public function ToString()
    {
        return "Usuario: ".'<br>'.$this->unUsuario->ToString().'<br>'
        ."importe: ".$this->importe.'<br>'
        ."fechaDelDeposito: ".$this->fechaDelDeposito.'<br>';
    }
    public static function ToStringList($listaDeDeposito)
    {
        $strLista = null; 

        if(isset($listaDeDeposito) )
        {
            foreach($listaDeDeposito as $unaDeposito)
            {
                $strLista = $unaDeposito->ToString().'<br>';
            }
        }

        return   $strLista;
    }
}


?>